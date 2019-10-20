<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * @var bool
     */
    private $isDetail;

    /**
     * NewsResource constructor.
     *
     * @param bool $isDetail
     * @param $resource
     */
    public function __construct($resource, $isDetail = false)
    {
        parent::__construct($resource);
        $this->isDetail = $isDetail;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id'            => $this->id,
            'title'         => $this->title,
            'status'        => $this->status,
            'customer_id'        => $this->customer_id,
//            'category'    => new CategoryNewsResource($this->category),
            'avatar'        => $this->avatar,
            'images'        => $this->images,
            'videos'        => $this->videos,
            'description'   => $this->description,
            'content'       => $this->content,
            'customer_likes'       => $this->customer_likes,
            'created_at'    => ($this->created_at) ? $this->created_at->toDateTimeString() : '',
            'updated_at'    => ($this->updated_at) ? $this->updated_at->toDateTimeString() : '',
        ];
//        if ($this->isDetail) {
//            $data['content'] = $this->content;
//        }

        return $data;
    }
}
