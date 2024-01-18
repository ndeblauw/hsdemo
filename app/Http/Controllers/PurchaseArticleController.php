<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;

class PurchaseArticleController extends Controller
{
    public function preparePayment(Post $post, Request $request)
    {
        $webhook_url = config('app.env') === 'production'
            ? route('webhooks.mollie')
            : "https://rg1jldtu1w.sharedwithexpose.com/webhooks/mollie";

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

            // Send thank you notification (and invoice) to user who bought the article

            // Send info to author of the post to inform about income
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
