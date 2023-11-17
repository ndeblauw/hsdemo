<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostTogglePublishController extends Controller
{
    public function toggle(Post $post)
    {
        if( auth()->id() !== $post->author_id) {
            //abort(401, 'you are not allowed to publish another one s post');

            session()->flash('error_notification', "You are not authorized for changes to Post '{$post->title}'");


            return redirect()->back();
        }

        $new_value = $post->published_at === null ? now() : null;
        $message = $new_value === null ? 'unpublished' : 'published';

        $post->update([
            'published_at' => $new_value
        ]);

        session()->flash('success_notification', "Post '{$post->title}' was $message.");

        return redirect()->back();
    }


}
