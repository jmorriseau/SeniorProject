<?php
/**
 * Class that manages the transfer of data between the front end and the data layer
 *
 * @author Mike
 */
Class API extends SQLJSON{
    private $data;
    private $db;

    public function getData(){
        return $this->data;
    }

    public function setData($data){
        $this->data = $data;
    }

    public function getDB(){
        return $this->db;
    }

    public function setDB($db){
        $this->$db = $db;
    }

    public function __construct($db) {
        $this->db = $db;
    }

    /*
     * API Resources Function for Buildings
     * REST SERVER CALLS FOR BUILDING RESOURCES
     */

    public function buildingResourceRun($resource,$verb, $id = NULL ,$inputData = NULL ){

    if ( 'building' === $resource ) {
        $buildingResource = new BuildingResource($this->getDB());
        if ( 'GET' === $verb ) {
            if ( NULL === $id ) {
                $this->setData($buildingResource->getAll());
            } else {
                $this->setData($buildingResource->get($id));
            }
        }

        if ( 'POST' === $verb ) {
            if ($inputData === NULL) {
                throw new Exception('Building could not be added');
            } else {
                $this->setData($buildingResource->post($inputData));
            }
        }

        if ( 'PUT' === $verb ) {
            //if put is the verb, check the ID. If null, throw an exception looking for a id.
            if ( NULL === $id && $inputData === NULL) {
                throw new InvalidArgumentException('Building ID ' . $id . ' was not found');
            } else {
                //if not, run the put function and set the message to the return.
                $this->setData($buildingResource->put($id,$inputData));
            }
        }

        if ('DELETE' === $verb) {
            //if the delete verb is selected, check the the id is not null, and if so, throw an exception.
            if ( NULL === $id ) {
                throw new InvalidArgumentException('Building ID ' . $id . ' was not found');
            } else {
                // if its all clear, set the message to the delete function return.
                $this->setData($buildingResource->delete($id));
            }
        }
    }
        // IMPORTANT!!! Return coming up.
        return $this->convertToJSON($this->getData());
    }

    /*
     * API Resource for Campus
     * REST SERVER CALLS NEEDS TO BE FIXED
     */
    public function campusResource($resource, $verb, $id = NULL ,$inputData = NULL ){
        if ( 'campus' === $resource ) {

            $campusResource = new CampusResource($this->getDB());
            if ( 'GET' === $verb ) {
                if ( NULL === $id ) {
                    $this->setData($campusResource->getAll());
                } else {
                    $this->setData($campusResource->get($id));
                }
            }

            if ( 'POST' === $verb ) {

                if ($inputData === NULL) {

                    throw new Exception('Building could not be added');
                } else {
                    $this->setData($campusResource->post($inputData));
                }
            }

            if ( 'PUT' === $verb ) {
                //if put is the verb, check the ID. If null, throw an exception looking for a id.
                if ( NULL === $id && $inputData === NULL) {
                    throw new InvalidArgumentException('Building ID ' . $id . ' was not found');
                } else {
                    //if not, run the put function and set the message to the return.
                    $this->setData($campusResource->put($id,$inputData));
                }
            }

            if ('DELETE' === $verb) {
                //if the delete verb is selected, check the the id is not null, and if so, throw an exception.
                if ( NULL === $id ) {
                    throw new InvalidArgumentException('Building ID ' . $id . ' was not found');
                } else {
                    // if its all clear, set the message to the delete function return.
                    $this->setData($campusResource->delete($id));
                }
            }
        }

        // IMPORTANT!!! Return coming up.
        return $this->convertToJSON($this->getData());

        }
}
