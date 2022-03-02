<?php
/**
 * QueryJobList
 *
 * PHP version 7.3
 *
 * @category Class
 * @package  App\OpenAPI
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * OpenAPI Tutorial
 *
 * OpenAPI Tutorial by halhorn
 *
 * The version of the OpenAPI document: 0.0.0
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.4.0-SNAPSHOT
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace App\OpenAPI\Model;

use \ArrayAccess;
use \App\OpenAPI\ObjectSerializer;

/**
 * QueryJobList Class Doc Comment
 *
 * @category Class
 * @description クエリパラメータ 仕事一覧
 * @package  App\OpenAPI
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class QueryJobList implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'queryJobList';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'title' => 'string',
        'content' => 'string',
        'attention' => 'bool',
        'jobCategoryId' => 'int',
        'price' => 'int',
        'welfare' => 'string',
        'holiday' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'title' => null,
        'content' => null,
        'attention' => null,
        'jobCategoryId' => null,
        'price' => null,
        'welfare' => null,
        'holiday' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'title' => 'title',
        'content' => 'content',
        'attention' => 'attention',
        'jobCategoryId' => 'jobCategoryId',
        'price' => 'price',
        'welfare' => 'welfare',
        'holiday' => 'holiday'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'title' => 'setTitle',
        'content' => 'setContent',
        'attention' => 'setAttention',
        'jobCategoryId' => 'setJobCategoryId',
        'price' => 'setPrice',
        'welfare' => 'setWelfare',
        'holiday' => 'setHoliday'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'title' => 'getTitle',
        'content' => 'getContent',
        'attention' => 'getAttention',
        'jobCategoryId' => 'getJobCategoryId',
        'price' => 'getPrice',
        'welfare' => 'getWelfare',
        'holiday' => 'getHoliday'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }


    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['title'] = $data['title'] ?? null;
        $this->container['content'] = $data['content'] ?? null;
        $this->container['attention'] = $data['attention'] ?? null;
        $this->container['jobCategoryId'] = $data['jobCategoryId'] ?? null;
        $this->container['price'] = $data['price'] ?? null;
        $this->container['welfare'] = $data['welfare'] ?? null;
        $this->container['holiday'] = $data['holiday'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets title
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->container['title'];
    }

    /**
     * Sets title
     *
     * @param string|null $title タイトル
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->container['title'] = $title;

        return $this;
    }

    /**
     * Gets content
     *
     * @return string|null
     */
    public function getContent()
    {
        return $this->container['content'];
    }

    /**
     * Sets content
     *
     * @param string|null $content 内容
     *
     * @return self
     */
    public function setContent($content)
    {
        $this->container['content'] = $content;

        return $this;
    }

    /**
     * Gets attention
     *
     * @return bool|null
     */
    public function getAttention()
    {
        return $this->container['attention'];
    }

    /**
     * Sets attention
     *
     * @param bool|null $attention 注目の求人
     *
     * @return self
     */
    public function setAttention($attention)
    {
        $this->container['attention'] = $attention;

        return $this;
    }

    /**
     * Gets jobCategoryId
     *
     * @return int|null
     */
    public function getJobCategoryId()
    {
        return $this->container['jobCategoryId'];
    }

    /**
     * Sets jobCategoryId
     *
     * @param int|null $jobCategoryId 職種id
     *
     * @return self
     */
    public function setJobCategoryId($jobCategoryId)
    {
        $this->container['jobCategoryId'] = $jobCategoryId;

        return $this;
    }

    /**
     * Gets price
     *
     * @return int|null
     */
    public function getPrice()
    {
        return $this->container['price'];
    }

    /**
     * Sets price
     *
     * @param int|null $price 金額
     *
     * @return self
     */
    public function setPrice($price)
    {
        $this->container['price'] = $price;

        return $this;
    }

    /**
     * Gets welfare
     *
     * @return string|null
     */
    public function getWelfare()
    {
        return $this->container['welfare'];
    }

    /**
     * Sets welfare
     *
     * @param string|null $welfare 福利厚生
     *
     * @return self
     */
    public function setWelfare($welfare)
    {
        $this->container['welfare'] = $welfare;

        return $this;
    }

    /**
     * Gets holiday
     *
     * @return string|null
     */
    public function getHoliday()
    {
        return $this->container['holiday'];
    }

    /**
     * Sets holiday
     *
     * @param string|null $holiday 休日
     *
     * @return self
     */
    public function setHoliday($holiday)
    {
        $this->container['holiday'] = $holiday;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}

