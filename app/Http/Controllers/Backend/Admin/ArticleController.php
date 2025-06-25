<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Blog;
use App\Models\Course;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Chapters;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function showCourseArticles($course_id)
    {
        $articles=Article::where('course_id',$course_id)->get();
       
        return view('backend.articles.index',compact('articles','course_id'));
    
    }
    public function showCourseBlogs($course_id)
    {
        
        if (!Gate::allows('blog_access')) {
            return abort(401);
        }
        // Grab all the blogs
        $blogs = Blog::where('course_id',$course_id)->get();
        if(request('course_location_id')){
            $blogs = Blog::where('course_id',$course_id)
           
            ->whereHas('courseLocations', function($query)  {
               
                $query->where('course_location_id', '=', request('course_location_id'))
                ->where('model_type', '=', 'App\Models\Blog');
            })
            ->orderBy('created_at', 'desc')
            ->get();
        }
        // Show the page
        $courseLocationsColl=session('locale') =='ar'?Course::find($course_id)
        ->locations:Course::find($course_id)->locations;
        $courseLocations=[];
        foreach ($courseLocationsColl as $key => $loc) {
            # code...
            
            $courseLocations[$loc->pivot->id]=session('locale') =='ar'?$loc->pivot->start_date.' '.$loc->name_ar:$loc->start_date.' '.$loc->name;
        }
        $course_location_id=request('course_location_id');
        return view('backend.articles.indexCourseBlogs', compact('blogs','course_id','courseLocations','course_location_id'));
        
    
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        $courses= Course::pluck('title','id')->prepend('Please select', '');
        $courses_ar= Course::pluck('title_ar','id')->prepend('Please select', '');
   
        return view('backend.articles.create',compact('courses','courses_ar'));
    }

    public function createCourseArticle($course_id)
    {
        //
        if (!Gate::allows('blog_create')) {
            return abort(401);
        }
        $course=Course::find($course_id);
        $category = Category::pluck('name','id')->prepend('Please select', '');
        $category_id=$course->category_id;
        // return view('backend.articles.createCourseArticle',compact('course_id'));
       
        $chapters= session('locale') =='ar'?$course->chapters->pluck('title_ar','id')->prepend('اختر فصل... ', ''):$course->chapters->pluck('title','id')->prepend('Please select', '');
        $courseLocations=[];
        $courseLocations=session('locale') =='ar'?Course::find($course_id)->locations->pluck('name_ar','pivot.id'):Course::find($course_id)->locations->pluck('name','pivot.id');

        return view('backend.articles.createCourseBlog',compact('course_id','category','category_id','chapters','courseLocations'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            
            'course_id' => 'required',
            'title' => 'required',
            'article' => 'required',
           
            
        ]);
        $article=Article::create(array_slice($request->all(),1));
        return redirect()->route('admin.courses.articles.index',$request->course_id)->withFlashSuccess(trans('alerts.backend.general.created'));
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
        
        $article = Article::findOrFail($id);
        return view('backend.articles.edit',compact('article'));
        //
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
        //
        $newData=array_slice($request->all(),2);
        $article=Article::findOrFail($id);
        $article->update($newData);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.general.updated'));
        

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
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }
}
