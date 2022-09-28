<?php namespace AppTeamgrid\Data\Http\Controllers;

    use AppTeamgrid\Data\Http\Resources\ProjectResource;
    use AppTeamgrid\Data\Models\Project;

    class ProjectController {
        function create() {
            $project = new Project;
            $project->fill(post());
            $project->save();

            return new ProjectResource($project);
        }

        function edit($id) {
            $project = Project::findOrFail($id);
            $project->fill(post());
            $project->save();
            
            return new ProjectResource($project);
        }

        function index() {
            $completed = get("completed");
            $projects = Project::all()
                ->when($completed, function ($query, $completed) {
                    return $query->where("completed", $completed);
                }, function ($query) {
                    return $query;
                });
                
            return ProjectResource::collection($projects);
        }
    }