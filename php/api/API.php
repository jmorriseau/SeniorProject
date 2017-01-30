<?php

/**
 * Class that manages the transfer of data between the front end and the data layer
 *
 * @author Mike
 */
Class API extends SQLJSON
{
    private $data;
    private $db;
    private $message;

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getDB()
    {
        return $this->db;
    }

    public function setDB($db)
    {
        $this->$db = $db;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function __construct($db)
    {
        $this->db = $db;
    }

    /*
     * API Resources Function for Buildings
     * REST SERVER CALLS FOR BUILDING RESOURCES
     */

    public function buildingResourceRun($resource, $verb, $id = NULL, $inputData = NULL)
    {
        $this->setMessage();
        if ('building' === $resource) {
            $buildingResource = new BuildingResource($this->getDB());
            if ('GET' === $verb) {
                if (NULL === $id) {
                    $this->setData($buildingResource->getAll());
                } else {
                    $this->setData($buildingResource->get($id));
                }
            }

            if ('POST' === $verb) {
                if ($inputData === NULL) {
                    throw new Exception('Building could not be added');
                } else {
                    $this->setMessage($buildingResource->post($inputData));
                }
            }

            if ('PUT' === $verb) {
                //if put is the verb, check the ID. If null, throw an exception looking for a id.
                if (NULL === $id && $inputData === NULL) {
                    throw new InvalidArgumentException('Building ID ' . $id . ' was not found');
                } else {
                    //if not, run the put function and set the message to the return.
                    $this->setMessage($buildingResource->put($id, $inputData));
                }
            }

            if ('DELETE' === $verb) {
                //if the delete verb is selected, check the the id is not null, and if so, throw an exception.
                if (NULL === $id) {
                    throw new InvalidArgumentException('Building ID ' . $id . ' was not found');
                } else {
                    // if its all clear, set the message to the delete function return.
                    $this->setMessage($buildingResource->delete($id));
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
    public function campusResourceRun($resource, $verb, $id = NULL, $inputData = NULL)
    {
        if ('campus' === $resource) {

            $campusResource = new CampusResource($this->getDB());
            if ('GET' === $verb) {
                if (NULL === $id) {
                    $this->setData($campusResource->getAll());
                } else {
                    $this->setData($campusResource->get($id));
                }
            }

            if ('POST' === $verb) {

                if ($inputData === NULL) {

                    throw new Exception('Campus could not be added');
                } else {
                    $this->setMessage($campusResource->post($inputData));
                }
            }

            if ('PUT' === $verb) {
                //if put is the verb, check the ID. If null, throw an exception looking for a id.
                if (NULL === $id && $inputData === NULL) {
                    throw new InvalidArgumentException('Campus ID ' . $id . ' was not found');
                } else {
                    //if not, run the put function and set the message to the return.
                    $this->setMessage($campusResource->put($id, $inputData));
                }
            }

            if ('DELETE' === $verb) {
                //if the delete verb is selected, check the the id is not null, and if so, throw an exception.
                if (NULL === $id) {
                    throw new InvalidArgumentException('Campus ID ' . $id . ' was not found');
                } else {
                    // if its all clear, set the message to the delete function return.
                    $this->setMessage($campusResource->delete($id));
                }
            }
        }

        // IMPORTANT!!! Return coming up.
        return $this->convertToJSON($this->getData());

    }


    public function attributeResourceRun($resource, $verb, $id = NULL, $inputData = NULL)
    {

        if ('attribute' === $resource) {

            $attributeResource = new AttributeResource($this->getDB());
            if ('GET' === $verb) {
                if (NULL === $id) {
                    $this->setData($attributeResource->getAll());
                } else {
                    $this->setData($attributeResource->get($id));
                }
            }

            if ('POST' === $verb) {

                if ($inputData === NULL) {

                    throw new Exception('Attribute could not be added');
                } else {
                    $this->setMessage($attributeResource->post($inputData));
                }
            }

            if ('PUT' === $verb) {
                //if put is the verb, check the ID. If null, throw an exception looking for a id.
                if (NULL === $id && $inputData === NULL) {
                    throw new InvalidArgumentException('Attribute ID ' . $id . ' was not found');
                } else {
                    //if not, run the put function and set the message to the return.
                    $this->setMessage($attributeResource->put($id, $inputData));
                }
            }

            if ('DELETE' === $verb) {
                //if the delete verb is selected, check the the id is not null, and if so, throw an exception.
                if (NULL === $id) {
                    throw new InvalidArgumentException('Attribute ID ' . $id . ' was not found');
                } else {
                    // if its all clear, set the message to the delete function return.
                    $this->setMessage($attributeResource->delete($id));
                }
            }
        }
        // IMPORTANT!!! Return coming up.
        return $this->convertToJSON($this->getData());

    }

    public function classroomResourceRun($resource, $verb, $id = NULL, $inputData = NULL)
    {
        if ('classroom' === $resource) {

            $classroomResource = new ClassroomResource($this->getDB());
            if ('GET' === $verb) {
                if (NULL === $id) {
                    $this->setData($classroomResource->getAll());
                } else {
                    $this->setData($classroomResource->get($id));
                }
            }

            if ('POST' === $verb) {

                if ($inputData === NULL) {

                    throw new Exception('Classroom could not be added');
                } else {
                    $this->setMessage($classroomResource->post($inputData));
                }
            }

            if ('PUT' === $verb) {
                //if put is the verb, check the ID. If null, throw an exception looking for a id.
                if (NULL === $id && $inputData === NULL) {
                    throw new InvalidArgumentException('Classroom ID ' . $id . ' was not found');
                } else {
                    //if not, run the put function and set the message to the return.
                    $this->setMessage($classroomResource->put($id, $inputData));
                }
            }

            if ('DELETE' === $verb) {
                //if the delete verb is selected, check the the id is not null, and if so, throw an exception.
                if (NULL === $id) {
                    throw new InvalidArgumentException('Classroom ID ' . $id . ' was not found');
                } else {
                    // if its all clear, set the message to the delete function return.
                    $this->setMessage($classroomResource->delete($id));
                }
            }
        }

// IMPORTANT!!! Return coming up.
        return $this->convertToJSON($this->getData());
    }

    public function departmentResourceRun($resource, $verb, $id = NULL, $inputData = NULL)
    {

        if ('department' === $resource) {

            $departmentResource = new DepartmentResource($this->getDB());
            if ('GET' === $verb) {
                if (NULL === $id) {
                    $this->setData($departmentResource->getAll());
                } else {
                    $this->setData($departmentResource->get($id));
                }
            }

            if ('POST' === $verb) {

                if ($inputData === NULL) {

                    throw new Exception('Department could not be added');
                } else {
                    $this->setMessage($departmentResource->post($inputData));
                }
            }

            if ('PUT' === $verb) {
                //if put is the verb, check the ID. If null, throw an exception looking for a id.
                if (NULL === $id && $inputData === NULL) {
                    throw new InvalidArgumentException('Department ID ' . $id . ' was not found');
                } else {
                    //if not, run the put function and set the message to the return.
                    $this->setMessage($departmentResource->put($id, $inputData));
                }
            }

            if ('DELETE' === $verb) {
                //if the delete verb is selected, check the the id is not null, and if so, throw an exception.
                if (NULL === $id) {
                    throw new InvalidArgumentException('Department ID ' . $id . ' was not found');
                } else {
                    // if its all clear, set the message to the delete function return.
                    $this->setMessage($departmentResource->delete($id));
                }
            }
        }

        // IMPORTANT!!! Return coming up.
        return $this->convertToJSON($this->getData());
    }
/*
 * *
 * COURSES NEEDS A RESOURCE
 */
    public function coursesResourceRun($resource, $verb, $id = NULL, $inputData = NULL)
    {

        if ('courses' === $resource) {

            $coursesResource = new CoursesResource($this->getDB());
            if ('GET' === $verb) {
                if (NULL === $id) {
                    $this->setData($coursesResource->getAll());
                } else {
                    $this->setData($coursesResource->get($id));
                }
            }

            if ('POST' === $verb) {

                if ($inputData === NULL) {

                    throw new Exception('Course could not be added');
                } else {
                    $this->setMessage($coursesResource->post($inputData));
                }
            }

            if ('PUT' === $verb) {
                //if put is the verb, check the ID. If null, throw an exception looking for a id.
                if (NULL === $id && $inputData === NULL) {
                    throw new InvalidArgumentException('Courses ID ' . $id . ' was not found');
                } else {
                    //if not, run the put function and set the message to the return.
                    $this->setMessage($coursesResource->put($id, $inputData));
                }
            }

            if ('DELETE' === $verb) {
                //if the delete verb is selected, check the the id is not null, and if so, throw an exception.
                if (NULL === $id) {
                    throw new InvalidArgumentException(' Courses ID ' . $id . ' was not found');
                } else {
                    // if its all clear, set the message to the delete function return.
                    $this->setMessage($coursesResource->delete($id));
                }
            }
        }

        // IMPORTANT!!! Return coming up.
        return $this->convertToJSON($this->getData());
    }


}
