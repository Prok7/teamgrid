<?php
    namespace Jozef\Teamgrid\Http\Resources;
    use Illuminate\Http\Resources\Json\JsonResource;

    class TaskResource extends JsonResource {
        function toArray($request) {
            return [
                "id" => $this->id,
                "project_id" => $this->project_id,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at,
                "text" => $this->text,
                "planned_start" => $this->planned_start,
                "planned_end" => $this->planned_end,
                "planned_time" => $this->planned_time,
                "deadline" => $this->deadline
            ];
        }
    }