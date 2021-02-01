<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
     //   return parent::toArray($request);

     return [
         'q-id' => $this->id,
         'title' => $this->title,
         'op-1' => $this->option_1,
         'op-2' => $this->option_2,
         'op-3' => $this->option_3,
         'op-4' => $this->option_4,
         'right_ans' => $this->right_ans,
         
     ];
    }
}
