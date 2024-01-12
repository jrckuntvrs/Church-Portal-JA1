<?php

/**
 * POS Terminal Management API
 *
 * The version of the OpenAPI document: 1
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 6.4.0
 *
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


namespace Adyen\Model\POSTerminalManagement;

use \ArrayAccess;
use Adyen\Model\POSTerminalManagement\ObjectSerializer;

/**
 * GetTerminalDetailsResponse Class Doc Comment
 *
 * @category Class
 * @package  Adyen
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class GetTerminalDetailsResponse implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'GetTerminalDetailsResponse';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'bluetoothIp' => 'string',
        'bluetoothMac' => 'string',
        'companyAccount' => 'string',
        'country' => 'string',
        'deviceModel' => 'string',
        'dhcpEnabled' => 'bool',
        'displayLabel' => 'string',
        'ethernetIp' => 'string',
        'ethernetMac' => 'string',
        'firmwareVersion' => 'string',
        'iccid' => 'string',
        'lastActivityDateTime' => '\DateTime',
        'lastTransactionDateTime' => '\DateTime',
        'linkNegotiation' => 'string',
        'merchantAccount' => 'string',
        'merchantInventory' => 'bool',
        'permanentTerminalId' => 'string',
        'serialNumber' => 'string',
        'simStatus' => 'string',
        'store' => 'string',
        'storeDetails' => '\Adyen\Model\POSTerminalManagement\Store',
        'terminal' => 'string',
        'terminalStatus' => 'string',
        'wifiIp' => 'string',
        'wifiMac' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'bluetoothIp' => null,
        'bluetoothMac' => null,
        'companyAccount' => null,
        'country' => null,
        'deviceModel' => null,
        'dhcpEnabled' => null,
        'displayLabel' => null,
        'ethernetIp' => null,
        'ethernetMac' => null,
        'firmwareVersion' => null,
        'iccid' => null,
        'lastActivityDateTime' => 'date-time',
        'lastTransactionDateTime' => 'date-time',
        'linkNegotiation' => null,
        'merchantAccount' => null,
        'merchantInventory' => null,
        'permanentTerminalId' => null,
        'serialNumber' => null,
        'simStatus' => null,
        'store' => null,
        'storeDetails' => null,
        'terminal' => null,
        'terminalStatus' => null,
        'wifiIp' => null,
        'wifiMac' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static $openAPINullables = [
        'bluetoothIp' => false,
        'bluetoothMac' => false,
        'companyAccount' => false,
        'country' => false,
        'deviceModel' => false,
        'dhcpEnabled' => false,
        'displayLabel' => false,
        'ethernetIp' => false,
        'ethernetMac' => false,
        'firmwareVersion' => false,
        'iccid' => false,
        'lastActivityDateTime' => false,
        'lastTransactionDateTime' => false,
        'linkNegotiation' => false,
        'merchantAccount' => false,
        'merchantInventory' => false,
        'permanentTerminalId' => false,
        'serialNumber' => false,
        'simStatus' => false,
        'store' => false,
        'storeDetails' => false,
        'terminal' => false,
        'terminalStatus' => false,
        'wifiIp' => false,
        'wifiMac' => false
    ];

    /**
      * If a nullable field gets set to null, insert it here
      *
      * @var boolean[]
      */
    protected $openAPINullablesSetToNull = [];

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
     * Array of nullable properties
     *
     * @return array
     */
    protected static function openAPINullables(): array
    {
        return self::$openAPINullables;
    }

    /**
     * Array of nullable field names deliberately set to null
     *
     * @return boolean[]
     */
    private function getOpenAPINullablesSetToNull(): array
    {
        return $this->openAPINullablesSetToNull;
    }

    /**
     * Setter - Array of nullable field names deliberately set to null
     *
     * @param boolean[] $openAPINullablesSetToNull
     */
    private function setOpenAPINullablesSetToNull(array $openAPINullablesSetToNull): void
    {
        $this->openAPINullablesSetToNull = $openAPINullablesSetToNull;
    }

    /**
     * Checks if a property is nullable
     *
     * @param string $property
     * @return bool
     */
    public static function isNullable(string $property): bool
    {
        return self::openAPINullables()[$property] ?? false;
    }

    /**
     * Checks if a nullable property is set to null.
     *
     * @param string $property
     * @return bool
     */
    public function isNullableSetToNull(string $property): bool
    {
        return in_array($property, $this->getOpenAPINullablesSetToNull(), true);
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'bluetoothIp' => 'bluetoothIp',
        'bluetoothMac' => 'bluetoothMac',
        'companyAccount' => 'companyAccount',
        'country' => 'country',
        'deviceModel' => 'deviceModel',
        'dhcpEnabled' => 'dhcpEnabled',
        'displayLabel' => 'displayLabel',
        'ethernetIp' => 'ethernetIp',
        'ethernetMac' => 'ethernetMac',
        'firmwareVersion' => 'firmwareVersion',
        'iccid' => 'iccid',
        'lastActivityDateTime' => 'lastActivityDateTime',
        'lastTransactionDateTime' => 'lastTransactionDateTime',
        'linkNegotiation' => 'linkNegotiation',
        'merchantAccount' => 'merchantAccount',
        'merchantInventory' => 'merchantInventory',
        'permanentTerminalId' => 'permanentTerminalId',
        'serialNumber' => 'serialNumber',
        'simStatus' => 'simStatus',
        'store' => 'store',
        'storeDetails' => 'storeDetails',
        'terminal' => 'terminal',
        'terminalStatus' => 'terminalStatus',
        'wifiIp' => 'wifiIp',
        'wifiMac' => 'wifiMac'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'bluetoothIp' => 'setBluetoothIp',
        'bluetoothMac' => 'setBluetoothMac',
        'companyAccount' => 'setCompanyAccount',
        'country' => 'setCountry',
        'deviceModel' => 'setDeviceModel',
        'dhcpEnabled' => 'setDhcpEnabled',
        'displayLabel' => 'setDisplayLabel',
        'ethernetIp' => 'setEthernetIp',
        'ethernetMac' => 'setEthernetMac',
        'firmwareVersion' => 'setFirmwareVersion',
        'iccid' => 'setIccid',
        'lastActivityDateTime' => 'setLastActivityDateTime',
        'lastTransactionDateTime' => 'setLastTransactionDateTime',
        'linkNegotiation' => 'setLinkNegotiation',
        'merchantAccount' => 'setMerchantAccount',
        'merchantInventory' => 'setMerchantInventory',
        'permanentTerminalId' => 'setPermanentTerminalId',
        'serialNumber' => 'setSerialNumber',
        'simStatus' => 'setSimStatus',
        'store' => 'setStore',
        'storeDetails' => 'setStoreDetails',
        'terminal' => 'setTerminal',
        'terminalStatus' => 'setTerminalStatus',
        'wifiIp' => 'setWifiIp',
        'wifiMac' => 'setWifiMac'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'bluetoothIp' => 'getBluetoothIp',
        'bluetoothMac' => 'getBluetoothMac',
        'companyAccount' => 'getCompanyAccount',
        'country' => 'getCountry',
        'deviceModel' => 'getDeviceModel',
        'dhcpEnabled' => 'getDhcpEnabled',
        'displayLabel' => 'getDisplayLabel',
        'ethernetIp' => 'getEthernetIp',
        'ethernetMac' => 'getEthernetMac',
        'firmwareVersion' => 'getFirmwareVersion',
        'iccid' => 'getIccid',
        'lastActivityDateTime' => 'getLastActivityDateTime',
        'lastTransactionDateTime' => 'getLastTransactionDateTime',
        'linkNegotiation' => 'getLinkNegotiation',
        'merchantAccount' => 'getMerchantAccount',
        'merchantInventory' => 'getMerchantInventory',
        'permanentTerminalId' => 'getPermanentTerminalId',
        'serialNumber' => 'getSerialNumber',
        'simStatus' => 'getSimStatus',
        'store' => 'getStore',
        'storeDetails' => 'getStoreDetails',
        'terminal' => 'getTerminal',
        'terminalStatus' => 'getTerminalStatus',
        'wifiIp' => 'getWifiIp',
        'wifiMac' => 'getWifiMac'
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

    public const TERMINAL_STATUS_ONLINE_LAST1_DAY = 'OnlineLast1Day';
    public const TERMINAL_STATUS_ONLINE_LAST2_DAYS = 'OnlineLast2Days';
    public const TERMINAL_STATUS_ONLINE_LAST3_DAYS = 'OnlineLast3Days';
    public const TERMINAL_STATUS_ONLINE_LAST4_DAYS = 'OnlineLast4Days';
    public const TERMINAL_STATUS_ONLINE_LAST5_DAYS = 'OnlineLast5Days';
    public const TERMINAL_STATUS_ONLINE_LAST6_DAYS = 'OnlineLast6Days';
    public const TERMINAL_STATUS_ONLINE_LAST7_DAYS = 'OnlineLast7Days';
    public const TERMINAL_STATUS_ONLINE_TODAY = 'OnlineToday';
    public const TERMINAL_STATUS_RE_ASSIGN_TO_INVENTORY_PENDING = 'ReAssignToInventoryPending';
    public const TERMINAL_STATUS_RE_ASSIGN_TO_MERCHANT_INVENTORY_PENDING = 'ReAssignToMerchantInventoryPending';
    public const TERMINAL_STATUS_RE_ASSIGN_TO_STORE_PENDING = 'ReAssignToStorePending';
    public const TERMINAL_STATUS_SWITCHED_OFF = 'SwitchedOff';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTerminalStatusAllowableValues()
    {
        return [
            self::TERMINAL_STATUS_ONLINE_LAST1_DAY,
            self::TERMINAL_STATUS_ONLINE_LAST2_DAYS,
            self::TERMINAL_STATUS_ONLINE_LAST3_DAYS,
            self::TERMINAL_STATUS_ONLINE_LAST4_DAYS,
            self::TERMINAL_STATUS_ONLINE_LAST5_DAYS,
            self::TERMINAL_STATUS_ONLINE_LAST6_DAYS,
            self::TERMINAL_STATUS_ONLINE_LAST7_DAYS,
            self::TERMINAL_STATUS_ONLINE_TODAY,
            self::TERMINAL_STATUS_RE_ASSIGN_TO_INVENTORY_PENDING,
            self::TERMINAL_STATUS_RE_ASSIGN_TO_MERCHANT_INVENTORY_PENDING,
            self::TERMINAL_STATUS_RE_ASSIGN_TO_STORE_PENDING,
            self::TERMINAL_STATUS_SWITCHED_OFF,
        ];
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
        $this->setIfExists('bluetoothIp', $data ?? [], null);
        $this->setIfExists('bluetoothMac', $data ?? [], null);
        $this->setIfExists('companyAccount', $data ?? [], null);
        $this->setIfExists('country', $data ?? [], null);
        $this->setIfExists('deviceModel', $data ?? [], null);
        $this->setIfExists('dhcpEnabled', $data ?? [], null);
        $this->setIfExists('displayLabel', $data ?? [], null);
        $this->setIfExists('ethernetIp', $data ?? [], null);
        $this->setIfExists('ethernetMac', $data ?? [], null);
        $this->setIfExists('firmwareVersion', $data ?? [], null);
        $this->setIfExists('iccid', $data ?? [], null);
        $this->setIfExists('lastActivityDateTime', $data ?? [], null);
        $this->setIfExists('lastTransactionDateTime', $data ?? [], null);
        $this->setIfExists('linkNegotiation', $data ?? [], null);
        $this->setIfExists('merchantAccount', $data ?? [], null);
        $this->setIfExists('merchantInventory', $data ?? [], null);
        $this->setIfExists('permanentTerminalId', $data ?? [], null);
        $this->setIfExists('serialNumber', $data ?? [], null);
        $this->setIfExists('simStatus', $data ?? [], null);
        $this->setIfExists('store', $data ?? [], null);
        $this->setIfExists('storeDetails', $data ?? [], null);
        $this->setIfExists('terminal', $data ?? [], null);
        $this->setIfExists('terminalStatus', $data ?? [], null);
        $this->setIfExists('wifiIp', $data ?? [], null);
        $this->setIfExists('wifiMac', $data ?? [], null);
    }

    /**
    * Sets $this->container[$variableName] to the given data or to the given default Value; if $variableName
    * is nullable and its value is set to null in the $fields array, then mark it as "set to null" in the
    * $this->openAPINullablesSetToNull array
    *
    * @param string $variableName
    * @param array  $fields
    * @param mixed  $defaultValue
    */
    private function setIfExists(string $variableName, array $fields, $defaultValue): void
    {
        if (self::isNullable($variableName) && array_key_exists($variableName, $fields) && is_null($fields[$variableName])) {
            $this->openAPINullablesSetToNull[] = $variableName;
        }

        $this->container[$variableName] = $fields[$variableName] ?? $defaultValue;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['companyAccount'] === null) {
            $invalidProperties[] = "'companyAccount' can't be null";
        }
        if ($this->container['terminal'] === null) {
            $invalidProperties[] = "'terminal' can't be null";
        }
        $allowedValues = $this->getTerminalStatusAllowableValues();
        if (!is_null($this->container['terminalStatus']) && !in_array($this->container['terminalStatus'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'terminalStatus', must be one of '%s'",
                $this->container['terminalStatus'],
                implode("', '", $allowedValues)
            );
        }

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
     * Gets bluetoothIp
     *
     * @return string|null
     */
    public function getBluetoothIp()
    {
        return $this->container['bluetoothIp'];
    }

    /**
     * Sets bluetoothIp
     *
     * @param string|null $bluetoothIp The Bluetooth IP address of the terminal.
     *
     * @return self
     */
    public function setBluetoothIp($bluetoothIp)
    {
        if (is_null($bluetoothIp)) {
            throw new \InvalidArgumentException('non-nullable bluetoothIp cannot be null');
        }
        $this->container['bluetoothIp'] = $bluetoothIp;

        return $this;
    }

    /**
     * Gets bluetoothMac
     *
     * @return string|null
     */
    public function getBluetoothMac()
    {
        return $this->container['bluetoothMac'];
    }

    /**
     * Sets bluetoothMac
     *
     * @param string|null $bluetoothMac The Bluetooth MAC address of the terminal.
     *
     * @return self
     */
    public function setBluetoothMac($bluetoothMac)
    {
        if (is_null($bluetoothMac)) {
            throw new \InvalidArgumentException('non-nullable bluetoothMac cannot be null');
        }
        $this->container['bluetoothMac'] = $bluetoothMac;

        return $this;
    }

    /**
     * Gets companyAccount
     *
     * @return string
     */
    public function getCompanyAccount()
    {
        return $this->container['companyAccount'];
    }

    /**
     * Sets companyAccount
     *
     * @param string $companyAccount The company account that the terminal is associated with. If this is the only account level shown in the response, the terminal is assigned to the inventory of the company account.
     *
     * @return self
     */
    public function setCompanyAccount($companyAccount)
    {
        if (is_null($companyAccount)) {
            throw new \InvalidArgumentException('non-nullable companyAccount cannot be null');
        }
        $this->container['companyAccount'] = $companyAccount;

        return $this;
    }

    /**
     * Gets country
     *
     * @return string|null
     */
    public function getCountry()
    {
        return $this->container['country'];
    }

    /**
     * Sets country
     *
     * @param string|null $country The country where the terminal is used.
     *
     * @return self
     */
    public function setCountry($country)
    {
        if (is_null($country)) {
            throw new \InvalidArgumentException('non-nullable country cannot be null');
        }
        $this->container['country'] = $country;

        return $this;
    }

    /**
     * Gets deviceModel
     *
     * @return string|null
     */
    public function getDeviceModel()
    {
        return $this->container['deviceModel'];
    }

    /**
     * Sets deviceModel
     *
     * @param string|null $deviceModel The model name of the terminal.
     *
     * @return self
     */
    public function setDeviceModel($deviceModel)
    {
        if (is_null($deviceModel)) {
            throw new \InvalidArgumentException('non-nullable deviceModel cannot be null');
        }
        $this->container['deviceModel'] = $deviceModel;

        return $this;
    }

    /**
     * Gets dhcpEnabled
     *
     * @return bool|null
     */
    public function getDhcpEnabled()
    {
        return $this->container['dhcpEnabled'];
    }

    /**
     * Sets dhcpEnabled
     *
     * @param bool|null $dhcpEnabled Indicates whether assigning IP addresses through a DHCP server is enabled on the terminal.
     *
     * @return self
     */
    public function setDhcpEnabled($dhcpEnabled)
    {
        if (is_null($dhcpEnabled)) {
            throw new \InvalidArgumentException('non-nullable dhcpEnabled cannot be null');
        }
        $this->container['dhcpEnabled'] = $dhcpEnabled;

        return $this;
    }

    /**
     * Gets displayLabel
     *
     * @return string|null
     */
    public function getDisplayLabel()
    {
        return $this->container['displayLabel'];
    }

    /**
     * Sets displayLabel
     *
     * @param string|null $displayLabel The label shown on the status bar of the display. This label (if any) is specified in your Customer Area.
     *
     * @return self
     */
    public function setDisplayLabel($displayLabel)
    {
        if (is_null($displayLabel)) {
            throw new \InvalidArgumentException('non-nullable displayLabel cannot be null');
        }
        $this->container['displayLabel'] = $displayLabel;

        return $this;
    }

    /**
     * Gets ethernetIp
     *
     * @return string|null
     */
    public function getEthernetIp()
    {
        return $this->container['ethernetIp'];
    }

    /**
     * Sets ethernetIp
     *
     * @param string|null $ethernetIp The terminal's IP address in your Ethernet network.
     *
     * @return self
     */
    public function setEthernetIp($ethernetIp)
    {
        if (is_null($ethernetIp)) {
            throw new \InvalidArgumentException('non-nullable ethernetIp cannot be null');
        }
        $this->container['ethernetIp'] = $ethernetIp;

        return $this;
    }

    /**
     * Gets ethernetMac
     *
     * @return string|null
     */
    public function getEthernetMac()
    {
        return $this->container['ethernetMac'];
    }

    /**
     * Sets ethernetMac
     *
     * @param string|null $ethernetMac The terminal's MAC address in your Ethernet network.
     *
     * @return self
     */
    public function setEthernetMac($ethernetMac)
    {
        if (is_null($ethernetMac)) {
            throw new \InvalidArgumentException('non-nullable ethernetMac cannot be null');
        }
        $this->container['ethernetMac'] = $ethernetMac;

        return $this;
    }

    /**
     * Gets firmwareVersion
     *
     * @return string|null
     */
    public function getFirmwareVersion()
    {
        return $this->container['firmwareVersion'];
    }

    /**
     * Sets firmwareVersion
     *
     * @param string|null $firmwareVersion The software release currently in use on the terminal.
     *
     * @return self
     */
    public function setFirmwareVersion($firmwareVersion)
    {
        if (is_null($firmwareVersion)) {
            throw new \InvalidArgumentException('non-nullable firmwareVersion cannot be null');
        }
        $this->container['firmwareVersion'] = $firmwareVersion;

        return $this;
    }

    /**
     * Gets iccid
     *
     * @return string|null
     */
    public function getIccid()
    {
        return $this->container['iccid'];
    }

    /**
     * Sets iccid
     *
     * @param string|null $iccid The integrated circuit card identifier (ICCID) of the SIM card in the terminal.
     *
     * @return self
     */
    public function setIccid($iccid)
    {
        if (is_null($iccid)) {
            throw new \InvalidArgumentException('non-nullable iccid cannot be null');
        }
        $this->container['iccid'] = $iccid;

        return $this;
    }

    /**
     * Gets lastActivityDateTime
     *
     * @return \DateTime|null
     */
    public function getLastActivityDateTime()
    {
        return $this->container['lastActivityDateTime'];
    }

    /**
     * Sets lastActivityDateTime
     *
     * @param \DateTime|null $lastActivityDateTime Date and time of the last activity on the terminal. Not included when the last activity was more than 14 days ago.
     *
     * @return self
     */
    public function setLastActivityDateTime($lastActivityDateTime)
    {
        if (is_null($lastActivityDateTime)) {
            throw new \InvalidArgumentException('non-nullable lastActivityDateTime cannot be null');
        }
        $this->container['lastActivityDateTime'] = $lastActivityDateTime;

        return $this;
    }

    /**
     * Gets lastTransactionDateTime
     *
     * @return \DateTime|null
     */
    public function getLastTransactionDateTime()
    {
        return $this->container['lastTransactionDateTime'];
    }

    /**
     * Sets lastTransactionDateTime
     *
     * @param \DateTime|null $lastTransactionDateTime Date and time of the last transaction on the terminal. Not included when the last transaction was more than 14 days ago.
     *
     * @return self
     */
    public function setLastTransactionDateTime($lastTransactionDateTime)
    {
        if (is_null($lastTransactionDateTime)) {
            throw new \InvalidArgumentException('non-nullable lastTransactionDateTime cannot be null');
        }
        $this->container['lastTransactionDateTime'] = $lastTransactionDateTime;

        return $this;
    }

    /**
     * Gets linkNegotiation
     *
     * @return string|null
     */
    public function getLinkNegotiation()
    {
        return $this->container['linkNegotiation'];
    }

    /**
     * Sets linkNegotiation
     *
     * @param string|null $linkNegotiation The Ethernet link negotiation that the terminal uses:   - `auto`: Auto-negotiation  - `100full`: 100 Mbps full duplex
     *
     * @return self
     */
    public function setLinkNegotiation($linkNegotiation)
    {
        if (is_null($linkNegotiation)) {
            throw new \InvalidArgumentException('non-nullable linkNegotiation cannot be null');
        }
        $this->container['linkNegotiation'] = $linkNegotiation;

        return $this;
    }

    /**
     * Gets merchantAccount
     *
     * @return string|null
     */
    public function getMerchantAccount()
    {
        return $this->container['merchantAccount'];
    }

    /**
     * Sets merchantAccount
     *
     * @param string|null $merchantAccount The merchant account that the terminal is associated with. If the response doesn't contain a `store` the terminal is assigned to this merchant account.
     *
     * @return self
     */
    public function setMerchantAccount($merchantAccount)
    {
        if (is_null($merchantAccount)) {
            throw new \InvalidArgumentException('non-nullable merchantAccount cannot be null');
        }
        $this->container['merchantAccount'] = $merchantAccount;

        return $this;
    }

    /**
     * Gets merchantInventory
     *
     * @return bool|null
     */
    public function getMerchantInventory()
    {
        return $this->container['merchantInventory'];
    }

    /**
     * Sets merchantInventory
     *
     * @param bool|null $merchantInventory Boolean that indicates if the terminal is assigned to the merchant inventory. This is returned when the terminal is assigned to a merchant account.  - If **true**, this indicates that the terminal is in the merchant inventory. This also means that the terminal cannot be boarded.  - If **false**, this indicates that the terminal is assigned to the merchant account as an in-store terminal. This means that the terminal is ready to be boarded, or is already boarded.
     *
     * @return self
     */
    public function setMerchantInventory($merchantInventory)
    {
        if (is_null($merchantInventory)) {
            throw new \InvalidArgumentException('non-nullable merchantInventory cannot be null');
        }
        $this->container['merchantInventory'] = $merchantInventory;

        return $this;
    }

    /**
     * Gets permanentTerminalId
     *
     * @return string|null
     */
    public function getPermanentTerminalId()
    {
        return $this->container['permanentTerminalId'];
    }

    /**
     * Sets permanentTerminalId
     *
     * @param string|null $permanentTerminalId The permanent terminal ID.
     *
     * @return self
     */
    public function setPermanentTerminalId($permanentTerminalId)
    {
        if (is_null($permanentTerminalId)) {
            throw new \InvalidArgumentException('non-nullable permanentTerminalId cannot be null');
        }
        $this->container['permanentTerminalId'] = $permanentTerminalId;

        return $this;
    }

    /**
     * Gets serialNumber
     *
     * @return string|null
     */
    public function getSerialNumber()
    {
        return $this->container['serialNumber'];
    }

    /**
     * Sets serialNumber
     *
     * @param string|null $serialNumber The serial number of the terminal.
     *
     * @return self
     */
    public function setSerialNumber($serialNumber)
    {
        if (is_null($serialNumber)) {
            throw new \InvalidArgumentException('non-nullable serialNumber cannot be null');
        }
        $this->container['serialNumber'] = $serialNumber;

        return $this;
    }

    /**
     * Gets simStatus
     *
     * @return string|null
     */
    public function getSimStatus()
    {
        return $this->container['simStatus'];
    }

    /**
     * Sets simStatus
     *
     * @param string|null $simStatus On a terminal that supports 3G or 4G connectivity, indicates the status of the SIM card in the terminal: ACTIVE or INVENTORY.
     *
     * @return self
     */
    public function setSimStatus($simStatus)
    {
        if (is_null($simStatus)) {
            throw new \InvalidArgumentException('non-nullable simStatus cannot be null');
        }
        $this->container['simStatus'] = $simStatus;

        return $this;
    }

    /**
     * Gets store
     *
     * @return string|null
     */
    public function getStore()
    {
        return $this->container['store'];
    }

    /**
     * Sets store
     *
     * @param string|null $store The store code of the store that the terminal is assigned to.
     *
     * @return self
     */
    public function setStore($store)
    {
        if (is_null($store)) {
            throw new \InvalidArgumentException('non-nullable store cannot be null');
        }
        $this->container['store'] = $store;

        return $this;
    }

    /**
     * Gets storeDetails
     *
     * @return \Adyen\Model\POSTerminalManagement\Store|null
     */
    public function getStoreDetails()
    {
        return $this->container['storeDetails'];
    }

    /**
     * Sets storeDetails
     *
     * @param \Adyen\Model\POSTerminalManagement\Store|null $storeDetails storeDetails
     *
     * @return self
     */
    public function setStoreDetails($storeDetails)
    {
        if (is_null($storeDetails)) {
            throw new \InvalidArgumentException('non-nullable storeDetails cannot be null');
        }
        $this->container['storeDetails'] = $storeDetails;

        return $this;
    }

    /**
     * Gets terminal
     *
     * @return string
     */
    public function getTerminal()
    {
        return $this->container['terminal'];
    }

    /**
     * Sets terminal
     *
     * @param string $terminal The unique terminal ID.
     *
     * @return self
     */
    public function setTerminal($terminal)
    {
        if (is_null($terminal)) {
            throw new \InvalidArgumentException('non-nullable terminal cannot be null');
        }
        $this->container['terminal'] = $terminal;

        return $this;
    }

    /**
     * Gets terminalStatus
     *
     * @return string|null
     */
    public function getTerminalStatus()
    {
        return $this->container['terminalStatus'];
    }

    /**
     * Sets terminalStatus
     *
     * @param string|null $terminalStatus The status of the terminal:   - `OnlineToday`, `OnlineLast1Day`, `OnlineLast2Days` etcetera to `OnlineLast7Days`: Indicates when in the past week the terminal was last online.   - `SwitchedOff`: Indicates it was more than a week ago that the terminal was last online.   - `ReAssignToInventoryPending`, `ReAssignToStorePending`, `ReAssignToMerchantInventoryPending`: Indicates the terminal is scheduled to be reassigned.
     *
     * @return self
     */
    public function setTerminalStatus($terminalStatus)
    {
        if (is_null($terminalStatus)) {
            throw new \InvalidArgumentException('non-nullable terminalStatus cannot be null');
        }
        $allowedValues = $this->getTerminalStatusAllowableValues();
        if (!in_array($terminalStatus, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'terminalStatus', must be one of '%s'",
                    $terminalStatus,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['terminalStatus'] = $terminalStatus;

        return $this;
    }

    /**
     * Gets wifiIp
     *
     * @return string|null
     */
    public function getWifiIp()
    {
        return $this->container['wifiIp'];
    }

    /**
     * Sets wifiIp
     *
     * @param string|null $wifiIp The terminal's IP address in your Wi-Fi network.
     *
     * @return self
     */
    public function setWifiIp($wifiIp)
    {
        if (is_null($wifiIp)) {
            throw new \InvalidArgumentException('non-nullable wifiIp cannot be null');
        }
        $this->container['wifiIp'] = $wifiIp;

        return $this;
    }

    /**
     * Gets wifiMac
     *
     * @return string|null
     */
    public function getWifiMac()
    {
        return $this->container['wifiMac'];
    }

    /**
     * Sets wifiMac
     *
     * @param string|null $wifiMac The terminal's MAC address in your Wi-Fi network.
     *
     * @return self
     */
    public function setWifiMac($wifiMac)
    {
        if (is_null($wifiMac)) {
            throw new \InvalidArgumentException('non-nullable wifiMac cannot be null');
        }
        $this->container['wifiMac'] = $wifiMac;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset): bool
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
    #[\ReturnTypeWillChange]
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
    public function offsetSet($offset, $value): void
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
    public function offsetUnset($offset): void
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
    #[\ReturnTypeWillChange]
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
}
