<?php
namespace App\Http\Controllers;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Database\Migrations\CreateFilesTable;


class userController extends Controller
{


public function create(){
    return view('create');
}

public function store(Request $req){

    $error=[];
$title=$req->title;
$content=$req->content;
$image=$req->image;
$validated = $req->validate([
    'title' => 'required|max:255|string',
    'content' => 'required|min:50','image'=>'required|image'
]);

$imageModel = new File;
    if($req->file()) {
        $imageName = time().'_'.$req->image;

        $imagePath = $req->file('image')->storeAs('uploads', $imageName, 'public');
        $imageModel->name =time().'_'.$req->image;
        $imageModel->image = '/storage/' . $imagePath;
        $imageModel->save();
        return back()
        ->with('success','image has been uploaded.')
        ->with('image', $imageName);



    }


dd($validated);


}
public function search(ArticleRequest $request){

 if ($request->hasFile('file')) {

    $file = Input::file('file');
    $imgTitle = $req->title;
    $imagePath = 'uploads/'. $imgTitle . '.jpg';
    $request->image_path = $imagePath;

    Article::create(array('title' => $req->title,
        'body' => $req->body,
        'image_path' => $imagePath));

    Image::make($file)->resize(300, 200)->save($imagePath);
} else {
//            $file = Input::file('file');
    $imgTitle = $req->title;

    $query = $imgTitle;

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://ajax.googleapis.com/ajax/services/search/images?v=1.0&q=" . urlencode($query));

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $output = json_decode(curl_exec($ch));

//            $file = file_get_contents($output);
    curl_close($ch);

    $imagePath = 'uploads/' . $imgTitle . '.jpg';

    $reqs->image_path = $imagePath;
    Article::create(array('title' => $req->title,
        'body' => $req->body,
        'image_path' => $imagePath));

    Image::make($output)->resize(300, 200)->save($imagePath);
}
}
}
?>
