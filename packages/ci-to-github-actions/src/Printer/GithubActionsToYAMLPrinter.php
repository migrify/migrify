<?php

declare(strict_types=1);

namespace Migrify\CIToGithubActions\Printer;

use Migrify\CIToGithubActions\ValueObject\GithubActions;
use Symfony\Component\Yaml\Yaml;

final class GithubActionsToYAMLPrinter
{
    public function print(GithubActions $githubActions): string
    {
        $data = [];

        foreach ($githubActions->getJobs() as $job) {
            $jobSteps = [];
            foreach ($job->getSteps() as $jobStep) {
                $jobSteps[]['uses'] = $jobStep->getUses();
            }

            $data['jobs'][$job->getName()] = [
                'runs-on' => $job->getRunsOn(),
                'steps' => $jobSteps,
            ];
        }

        return Yaml::dump($data, 100);
    }
}
