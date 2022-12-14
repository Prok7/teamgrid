<?php namespace AppTeamgrid\Data\Http\Resources;

    use Illuminate\Http\Resources\Json\JsonResource;
    use LibUser\Userapi\Http\Resources\UserResource;
    use AppTeamgrid\Data\Http\Resources\TimeEntryResource;
    use AppTeamgrid\Data\Http\Resources\ProjectResource;

    class TaskResource extends JsonResource {

        function toArray($request) {
            $totalSeconds = $this->time_entries()->sum("tracked_seconds");

            return [
                "id" => $this->id,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at,
                "title" => $this->title,
                "completed" => $this->completed,
                "planned_start" => $this->planned_start,
                "planned_end" => $this->planned_end,
                "planned_time" => $this->planned_time,
                "deadline" => $this->deadline,
                "tracking" => $this->tracking,
                "tracked_seconds" => $totalSeconds,
                "user" => new UserResource($this->user),
                "project" => new ProjectResource($this->project),
                "time_entries" => TimeEntryResource::collection($this->time_entries)
            ];
        }

    }