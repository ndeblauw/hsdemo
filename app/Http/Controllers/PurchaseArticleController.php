<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Notifications\InformAuthorOfPurchase;
use App\Notifications\ThankSponsorAfterPurchase;
use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;

class PurchaseArticleController extends Controller
{
    public function preparePayment(Post $post, Request $request)
    {
        $webhook_url = config('app.env') === 'production'
            ? route('webhooks.mollie')
            : "https://yjves6yjou.sharedwithexpose.com/webhooks/mollie";

        // validate!!!!!!!!!!!!
        $price = $request->amount;

        $payment = Mollie::api()->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => $price,
            ],
            "description" => "Order of post [".$post->id."] ".$post->title,
            "redirectUrl" => route('posts.purchase.success', ['post' => $post]),
            "webhookUrl" => $webhook_url,
            "metadata" => [
                "post_id" => $post->id,
                "sponsor_id" => auth()->id(),
            ],
        ]);

        $post->update([
            'payment_id' => $payment->id,
        ]);

        // redirect customer to Mollie checkout page
        return redirect($payment->getCheckoutUrl(), 303);

    }

    public function webhook(Request $request)
    {
        $paymentId = $request->input('id');
        $payment = Mollie::api()->payments->get($paymentId);

        if($payment->isPaid()) {
            $post = Post::find($payment->metadata->post_id);

            $post->update([
                    'sponsor_id' => $payment->metadata->sponsor_id,
                ]);

            $post->sponsor->notify(new ThankSponsorAfterPurchase($post));
            $post->author->notify(new InformAuthorOfPurchase($post));
        }
    }

    public function success(Post $post)
    {
        if($post->isSponsored()) {
            session()->flash('purchase_success', 'Thank you for buying this article');
        } else {
            session()->flash('purchase_pending', 'We are expecting the payment to be concluded soon');
        }

        return redirect()->route('posts.show', ['post' => $post]);
    }

}
