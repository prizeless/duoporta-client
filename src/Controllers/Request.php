<?php

namespace Duoporta\Controllers;

use Duoporta\Config\Api;
use Duoporta\Exceptions\MakesError;
use Duoporta\Utils\JsonParser;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use stdClass;

class Request
{
    /**
     * @param null $dateLastChanged Unix Timestamp If you want to get results changed since date
     *
     * @return stdClass
     * @throws MakesError
     */
    public function getRanges($dateLastChanged = null)
    {
        return $this->getApiResult(Api::BRANDS_URL, $dateLastChanged);
    }

    public function getSingleRange($rangeId)
    {
        return $this->getApiResult(Api::RANGES_URL . '/' . $rangeId);
    }

    /**
     * @param null $dateLastChanged Unix Timestamp If you want to get results changed since date
     * @param $modelId Model Id
     *
     * @return stdClass;
     * @throws MakesError
     */

    public function getModelDerivatives($modelId, $dateLastChanged = null)
    {
        return $this->getApiResult(Api::DERIVATIVES_BY_MODEL_URL . '/' . $modelId, $dateLastChanged);
    }

    /**
     * @param $derivativeId The derivative id from getModelDerivatives
     *
     * @return stdClass
     */
    public function getDerivativeSpecs($derivativeId)
    {
        return $this->getApiResult(Api::DERIVATIVE_SPEC_URL . '/' . $derivativeId);
    }

    /**
     * @param $derivativeId
     *
     * @return Array of stdClass
     */
    public function getDerivativePictures($derivativeId)
    {
        return $this->getApiResult(Api::DERIVATIVE_PICTURES_URL . '/' . $derivativeId);
    }

    /**
     * @param $derivativeId
     *
     * @return Array of stdClass
     */
    public function getDerivativePrices($derivativeId)
    {
        return $this->getApiResult(Api::DERIVATIVE_PRICES_URL . '/' . $derivativeId);
    }

    /**
     * @param $vehicle e.g. Audi
     *
     * @return array of stdClass
     */
    public function searchByMM($vehicle)
    {
        return $this->getApiResult(Api::MM_LOOKUP_URL . '/' . $vehicle);
    }

    /**
     * @return mixed
     */
    public function getMMCodes()
    {
        return $this->getApiResult(Api::MM_CODES_URL);
    }

    public function listMMCodes()
    {
        return $this->getApiResult(Api::MM_CODES_URL . '/list');
    }

    public function allDerivativeData($derivativeId)
    {
        return $this->getApiResult(Api::ALL_DERIVATIVE_DATA_URL . '/' . $derivativeId);
    }

    /**
     * @param $derivativeId The derivative id from getModelDerivatives
     *
     * @return mixed
     */
    public function getDerivativeFeatures($derivativeId)
    {
        return $this->getApiResult(Api::DERIVATIVE_FEATURES_URL . '/' . $derivativeId);
    }

    private function getApiResult($path, $dateLastChanged = null)
    {
        try {
            return $this->runPost($path, $dateLastChanged);
        } catch (ClientException $exception) {
            throw new MakesError($exception->getResponse()->getBody()->getContents());
        } catch (RequestException $exception) {
            throw new MakesError($exception->getResponse()->getBody()->getContents());
        } catch (ConnectException $exception) {
            throw new MakesError('Connection problem. Please try again or contact support.');
        }
    }

    private function runPost($path, $dateLastChanged)
    {
        $result = $this->getClient()->post(
            $this->getUri($path),
            ['form_params' => $this->getParameters($dateLastChanged), 'debug' => Api::DEBUG_API]
        )->getBody()->getContents();

        return JsonParser::decode($result);
    }

    private function getUri($path)
    {
        return Api::BASE_URL . $path;
    }

    private function getParameters($dateLastChanged)
    {
        $params = ['client_id' => Api::CLIENT_ID, 'api_key' => Api::API_KEY];

        if (empty($dateLastChanged) == false) {
            $params['last_changed'] = $dateLastChanged;
        }

        return $params;
    }

    private function getClient()
    {
        return new Client;
    }
}
