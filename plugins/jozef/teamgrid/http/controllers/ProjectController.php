<?php
    namespace Jozef\Teamgrid\Http\Controllers;
    use Jozef\Teamgrid\Http\Resources\ProjectResource;
    use Jozef\Teamgrid\Models\Project;

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
    }