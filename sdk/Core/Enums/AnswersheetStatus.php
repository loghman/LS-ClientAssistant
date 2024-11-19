<?php

namespace Ls\ClientAssistant\Core\Enums;

class AnswersheetStatus
{
    const Inprogress = 'inprogress';
    const AwaitingCorrection = 'awaiting_correction';
    const Failed = 'failed';
    const Passed = 'passed';
    const Canceled = 'canceled';
    const Survey = 'survey';
}