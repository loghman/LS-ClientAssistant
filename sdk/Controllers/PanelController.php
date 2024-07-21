<?php

namespace Ls\ClientAssistant\Controllers;

use Ls\ClientAssistant\Core\Router\WebResponse;

class PanelController
{
    public function panelCourses()
    {
        $brandNameEn = setting('brand_name_en');
        $brandLogoUrl = setting('logo_url');
        return WebResponse::view('sdk.pages.panel.courses.index'
            , compact('brandNameEn','brandLogoUrl')
        );
    }
    public function panelCourse()
    {
        $brandNameEn = setting('brand_name_en');
        $brandLogoUrl = setting('logo_url');
        return WebResponse::view('sdk.pages.panel.course.index'
            , compact('brandNameEn','brandLogoUrl')
        );
    }
}