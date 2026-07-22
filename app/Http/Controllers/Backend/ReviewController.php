<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Review;

use App\Http\Controllers\GlobalController;
use Validator, Redirect, Toastr, DB, File, Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::where('status', '!=', '3')->orderBy('created_at', 'desc');
        $queries = [];
        $columns = [
            'customer_name', 'status'
        ];

        foreach($columns as $column){
            if(request()->has($column) && !empty(request($column))){

                $reviews = $reviews->where($column, 'like', "%".request($column)."%");

                $queries[$column] = request($column);
            }
        }

        $per_page = 10;
        if(!empty(request('per_page'))){
            $per_page = request('per_page');
        }
        $reviews = $reviews->paginate($per_page)->appends($queries);
        return view('backend.reviews.index', ['reviews'=>$reviews]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.reviews.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $translation_data = GlobalController::get_translations();
        $validator = Validator::make($request->all(), [
            'customer_name' => ['required'],
            'review_text' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'image' => 'nullable|image',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput($request->all())->withErrors($validator);
        }

        $input = $request->all();
        $input['customer_name'] = trim($request->customer_name);
        $input['review_text'] = trim($request->review_text);

        if(!empty($request->image)){

            $files = $request->file('image');
            $name = $files->getClientOriginalName();
            $exp = explode(".", $name);
            $file_ext = end($exp);
            $name = md5($name.date('Y-m-d H:i:s')).'.'.$file_ext;

            $files->move(GlobalController::get_image_path("uploads/reviews/"), $name);
            $input['image'] = "uploads/reviews/".$name;
        }

        $review = Review::create($input);

        Toastr::success($review->customer_name . " " . ($translation_data['backendlang']['backendlang']['Create_Successfully'] ?? "Create Successfully"));
        return redirect()->route('review.reviews.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $review = Review::find($id);
        return view('backend.reviews.edit', ['review'=>$review]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $translation_data = GlobalController::get_translations();
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required',
            'review_text' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'image' => 'nullable|image',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput($request->all())->withErrors($validator);
        }

        $input = $request->all();
        $input['customer_name'] = trim($request->customer_name);
        $input['review_text'] = trim($request->review_text);

        if(!empty($request->image)){

            $files = $request->file('image');
            $name = $files->getClientOriginalName();
            $exp = explode(".", $name);
            $file_ext = end($exp);
            $name = md5($name.date('Y-m-d H:i:s')).'.'.$file_ext;

            $files->move(GlobalController::get_image_path("uploads/reviews/"), $name);
            $input['image'] = "uploads/reviews/".$name;
        }else{
            $input = $request->except(['image']);
        }

        $update = Review::find($id);
        $name = $update->customer_name;
        $update = $update->update($input);

        Toastr::success(($translation_data['backendlang']['backendlang']['Review'] ?? 'Review') . " " . $name . " " .($translation_data['backendlang']['backendlang']['Update_Successfully'] ?? 'Update Successfully') . "!");
        return redirect()->route('review.reviews.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
