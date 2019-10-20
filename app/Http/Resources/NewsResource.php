<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
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
            'id'          => $this->id,
            'title'       => $this->title,
            'category'    => new CategoryNewsResource($this->category),
            'image'       => $this->image,
            'description' => $this->description,
            'created_at'  => $this->created_at->toDateTimeString(),
        ];
        if ($this->isDetail) {
            $data['content'] = $this->content;
        }

        return $data;
    }
}
