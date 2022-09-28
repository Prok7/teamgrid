<?php namespace AppTeamgrid\Data\Http\Resources;

    use Illuminate\Http\Resources\Json\JsonResource;

    class TimeEntryResource extends JsonResource {

        function toArray($request) {
            return [
                "id" => $this->id,
                "task_id" => $this->task_id,
                "start_time" => $this->start_time,
                "end_time" => $this->end_time,
                "tracked_seconds" => $this->tracked_seconds
            ];
        }

    }