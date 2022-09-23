<?php 
    namespace Jozef\Teamgrid\Http\Resources;
    use Illuminate\Http\Resources\Json\JsonResource;

    class ProjectResource extends JsonResource {
        function toArray($request) {
            return [
                "id" => $this->id,
                "title" => $this->title,
                "status" => $this->status,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at
            ];
        }
    }