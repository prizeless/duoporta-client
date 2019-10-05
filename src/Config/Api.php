<?php

namespace Duoporta\Config;

use function defined;

class Api
{
    const BASE_URL = 'https://www.duoporta.com/api';

    const API_KEY = '';

    const CLIENT_ID = '';

    const DEBUG_API = false;

    const BRANDS_URL = '/brands';

    const RANGES_URL = '/ranges';

    const DERIVATIVES_BY_MODEL_URL = '/models/d';

    const DERIVATIVE_SPEC_URL = '/specifications/d';

    const DERIVATIVE_FEATURES_URL = '/features/d';

    const DERIVATIVE_PICTURES_URL = '/images/d';

    const DERIVATIVE_PRICES_URL = '/prices/d';

    const MM_LOOKUP_URL = '/mmlookup';

    const MM_CODES_URL = '/mmcodes';

    const ALL_DERIVATIVE_DATA_URL = '/dump';

    public static function getApiKey()
    {
        return defined('DUOPORTA_API_KEY') ? DUOPORTA_API_KEY : self::API_KEY;
    }

    public static function getClientId()
    {
        return defined('DUOPORTA_CLIENT_ID') ? DUOPORTA_CLIENT_ID : self::CLIENT_ID;
    }

    public static function getDebug()
    {
        return defined('DUOPORTA_API_DEBUG') ? DUOPORTA_API_DEBUG : self::DEBUG_API;
    }
}
