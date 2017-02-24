<?php
/**
 * Provides wrapper for WidgetApi + WidgetStorage
 */

class WidgetApiWrapper
{
    protected $widget_api;
    protected $widget_storage;
    protected $api_url;
    public function __construct($api_url, WidgetApi $widget_api, WidgetStorage $widget_storage)
    {
        $this->api_url = $api_url;
        $this->widget_api = $widget_api;
        $this->widget_storage = $widget_storage;
    }
    /**
     * Returns native PHP array from API call
     *
     * @param string $name = widget to find
     * @return array $array = native PHP array from JSON result
     */
    public function rawCallByName($name)
    {
        $raw = $this->widget_api->findByName($name);
        return json_decode($raw, true);
    }
    /**
     * Makes API call and stores info in database
     *
     * @param string $name = widget to find
     * @throws Exception $e if unable to store data
     * @return array $array = native PHP array from JSON result
     */
    public function callByName($name)
    {
        $data = $this->rawCallByName($name);
        if (!$this->widget_storage->save($data)) {
            // try changing to "Exception" and re-run test
            throw new PDOException('Unable to store data');
        }
        return $data;
    }
    /**
     * Returns WidgetApi instance
     *
     * @return WidgetApi $api
     */
     public function getApi()
     {
         return $this->widget_api;
     }
    /**
     * Returns WidgetStorage instance
     *
     * @return WidgetStorage $api
     */
     public function getStorage()
     {
         return $this->widget_storage;
     }
}
