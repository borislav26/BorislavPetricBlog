<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostCategory;
use App\Mail\SendMessage;
class ContactController extends Controller {

    public function index() {
        $newestPosts = Post::query()
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();
        $categoriesWithHighestPriority = PostCategory::query()
                ->orderBy('priority', 'desc')
                ->take(4)
                ->get();
        $postWithTheMostViews = Post::query()
                ->where('created_at', '>=', date('Y-m-d H:i:s', strtotime('-1 month')))
                ->orderBy('reviews', 'desc')
                ->limit(3)
                ->get();
        return view('front.contact.index', [
            'newestPosts' => $newestPosts,
            'categoriesWithHighestPriority' => $categoriesWithHighestPriority,
            'postWithTheMostViews'=>$postWithTheMostViews
        ]);
    }
    public function sendEmail(Request $request){
        $formData=$request->validate([
            'name'=>['required','string','min:3'],
            'email'=>['required','email'],
            'email_content'=>['required','string','min:10'],
            'g-recaptcha-response' => 'recaptcha'
        ]);

        \Mail::to('borislavpetric66@gmail.com')->send(new SendMessage($formData['name'],$formData['email'],$formData['email_content']));
        
        return redirect()->back();
    }

}
