<?php

namespace Modules\Comment\Http\Controllers;

use App\Http\Controllers\BaseResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Comment\Http\Requests\StoreCommentRequest;
use Modules\Comment\Http\Resources\CommentResource;
use Modules\Comment\Models\Comment;
use Modules\Comment\Repositories\CommentRepository;

class CommentController extends BaseResponse
{

    private $CommentRepository;
    public function __construct(CommentRepository $CommentRepository)
    {
        $this->CommentRepository = $CommentRepository;
    }

    function store(StoreCommentRequest $request)
    {

        DB::beginTransaction();
        try {
            $request->merge(['created_by' => auth()->user()->id]);
            $result = $this->CommentRepository->create($request->all());
            // dd($result);
            DB::commit();
            return $this->response(200, 'Comment is created Successfully', 200, [], [
                'Comment' => new CommentResource($result)
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }


}
