<?php

namespace app\traits;

use app\services\people\PeopleService;
use app\services\referral\ReferralLogService;
use app\services\referral\ReferralService;
use app\services\resume\ExperienceService;
use app\services\resume\ResumeService;
use app\services\resume\SkillService;
use app\services\user\UserBalanceService;
use app\services\workers\WorkersService;

/**
 * Trait ServicesTrait
 * @package app\traits
 */
trait ServicesTrait
{
    /**
     * @return ResumeService
     */
    public function resumeService(): ResumeService
    {
        return ResumeService::getInstance();
    }
    /**
     * @return SkillService
     */
    public function skillService(): SkillService
    {
        return SkillService::getInstance();
    }

    /**
     * @return ExperienceService
     */
    public function experienceService(): ExperienceService
    {
        return ExperienceService::getInstance();
    }

    /**
     * @return PeopleService
     */
    public function peopleService(): PeopleService
    {
        return PeopleService::getInstance();
    }

}
