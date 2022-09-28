<?php namespace AppTeamgrid\Data\Http\Resources;

    use Illuminate\Http\Resources\Json\JsonResource;

    class ProjectResource extends JsonResource {

        function toArray($request) {
            return [
                "id" => $this->id,
                "title" => $this->title,
                "completed" => $this->completed,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at
            ];
        }
        
    }