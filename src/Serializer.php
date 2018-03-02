<?php

namespace Drupal\jms_serializer;

use Doctrine\Common\Annotations\AnnotationRegistry;
use JMS\Serializer\SerializerBuilder;

/**
 * Class Serializer.
 *
 * @package Drupal\jms_serializer
 */
class Serializer {

  /**
   * Create a JMS Serializer.
   *
   * @return Serializer
   *   The Serializer.
   */
  protected function createSerializer() {
    static $serializer = NULL;

    if (NULL === $serializer) {
      AnnotationRegistry::registerAutoloadNamespace(
        'JMS\Serializer\Annotation',
        realpath(DRUPAL_ROOT . '/../vendor/jms/serializer/src')
      );

      $serializer = SerializerBuilder::create()->build();
    }

    return $serializer;
  }

  /**
   * Serialize an object to output format.
   *
   * @param mixed $object
   *   The object to serializer.
   * @param string $type
   *   The serialization format.
   *
   * @return string
   *   The serialized data.
   */
  public function serialize($object, $type) {
    $serializer = $this->createSerializer();

    return $serializer->serialize($object, $type);
  }

  /**
   * Serialize an object to json.
   *
   * @param mixed $object
   *   The object to serialize.
   *
   * @return string
   *   The json data.
   */
  public function serializeToJson($object) {
    return $this->serialize($object, 'json');
  }

  /**
   * Serialize an object to xml.
   *
   * @param mixed $object
   *   The object to serialize.
   *
   * @return string
   *   The serialized data.
   */
  public function serializerToXml($object) {
    return $this->serialize($object, 'xml');
  }

  /**
   * Deserialize a string to an object.
   *
   * @param mixed $data
   *   The data to deserialize.
   * @param string $type
   *   The target object type.
   * @param string $format
   *   The source format.
   *
   * @return mixed
   *   The deserialized object.
   */
  public function deSerialize($data, $type, $format) {
    $serializer = $this->createSerializer();

    return $serializer->deSerialize($data, $type, $format);
  }

  /**
   * Deserialize a json string to an object.
   *
   * @param string $data
   *    The json data.
   * @param string $type
   *   The target object type.
   *
   * @return mixed
   *   The deserialized object.
   */
  public function deSeralizerFromJson($data, $type) {
    return $this->deSerialize($data, $type, 'json');
  }

  /**
   * Deserialize an xml string to an object.
   *
   * @param string $data
   *   The xml data.
   * @param string $type
   *   The output object type.
   *
   * @return mixed
   *   The deserialized object.
   */
  public function deSerializeFromXml($data, $type) {
    return $this->deSerialize($data, $type, 'xml');
  }

}
