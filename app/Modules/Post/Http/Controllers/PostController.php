<?php

namespace Modules\Post\Http\Controllers;

use App\Http\Controllers\BaseResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Post\Http\Requests\DestroyPostRequest;
use Modules\Post\Http\Requests\StorePostRequest;
use Modules\Post\Http\Requests\UpdatePostRequest;
use Modules\Post\Http\Resources\PostResource;
use Modules\Post\Models\Post;
use Modules\Post\Repositories\PostRepository;

class PostController extends BaseResponse
{

    private $PostRepository;
    public function __construct(PostRepository $PostRepository)
    {
        $this->PostRepository = $PostRepository;
    }

    function index() {
        $result = $this->PostRepository->with(['comments','comments.replies']);
       
        return $this->response(200, 'List of Posts', 200, [], [
            'Posts' =>  PostResource::collection($result) 
           
        ]);
    }

    function store(StorePostRequest $request)
    {

        DB::beginTransaction();
        try {
            $request->merge(['created_by' => auth()->user()->id]);
            $result = $this->PostRepository->create($request->all());
            DB::commit();
            return $this->response(200, 'Post is created Successfully', 200, [], [
                'Post' => new PostResource($result)
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }


    public function update(UpdatePostRequest $request)
    {
        DB::beginTransaction();
        try {
            $checked = $this->PostRepository->checkifUserHasPost($request->post_id, auth()->user()->id);
            if (!$checked)
                return $this->response(101, 'Validation Error', 200, "You cann't update this post beacaus it's not not yours");
            $result = $this->PostRepository->update($request->all(), $request->post_id);
            // dd($result);
            DB::commit();
            return $this->response(200, 'Post is updated Successfully', 200, [], [
                'Post' => new PostResource($result)
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }

    public function destroy(DestroyPostRequest $request)
    {
        DB::beginTransaction();
        try {
            $checked = $this->PostRepository->checkifUserHasPost($request->post_id, auth()->user()->id);
            if (!$checked)
                return $this->response(101, 'Validation Error', 200, "You cann't delete this post beacaus it's not not yours");
            $this->PostRepository->destroy($request->post_id);
            DB::commit();
            return $this->response(200, 'Post is deleted Successfully', 200);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }
}
