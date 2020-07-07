<?php
namespace App;

class CronScheduler
{
    const ACTION = 'alps_cron';

    public function init()
    {
        if (!wp_next_scheduled(self::ACTION)) {
            wp_schedule_event(time(), 'twicedaily', self::ACTION);
        }
    }
}
