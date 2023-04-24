<?php

/**
 * Copyright © Rob Aimes - https://aimes.dev/
 * https://github.com/robaimes
 */

namespace Aimes\NativeExperience\Scope;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Store\Model\ScopeInterface;

class Config implements ArgumentInterface
{
    private const XML_PATH_NATIVE_EXPERIENCE_NETWORK_STATUS_ENABLED = 'native_experience/network_status/enabled';
    private const XML_PATH_NATIVE_EXPERIENCE_NETWORK_ONLINE_MESSAGE = 'native_experience/network_status/online_message';
    private const XML_PATH_NATIVE_EXPERIENCE_NETWORK_OFFLINE_MESSAGE = 'native_experience/network_status/offline_message';
    private const XML_PATH_NATIVE_EXPERIENCE_BATTERY_ENABLED = 'native_experience/battery/enabled';
    private const XML_PATH_NATIVE_EXPERIENCE_BATTERY_LOW_LEVEL_WARNING = 'native_experience/battery/low_level_warning';

    /** @var ScopeConfigInterface */
    private ScopeConfigInterface $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Check if network status features are enabled
     *
     * @return bool
     */
    public function isNetworkStatusEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_NATIVE_EXPERIENCE_NETWORK_STATUS_ENABLED,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get network status online message
     *
     * @return string
     */
    public function getNetworkStatusOnlineMessage(): string
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_NATIVE_EXPERIENCE_NETWORK_ONLINE_MESSAGE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get network status offline message
     *
     * @return string
     */
    public function getNetworkStatusOfflineMessage(): string
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_NATIVE_EXPERIENCE_NETWORK_OFFLINE_MESSAGE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Are battery features enabled
     *
     * @return string
     */
    public function isBatteryFeaturesEnabled(): string
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_NATIVE_EXPERIENCE_BATTERY_ENABLED,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get battery low level warning percentage
     *
     * @return int
     */
    public function getBatteryLowLevelWarning(): int
    {
        return (int)$this->scopeConfig->getValue(
            self::XML_PATH_NATIVE_EXPERIENCE_BATTERY_LOW_LEVEL_WARNING,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get low level warning message
     *
     * @return string
     */
    public function getBatteryWarningMessage(): string
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_NATIVE_EXPERIENCE_BATTERY_LOW_LEVEL_MESSAGE,
            ScopeInterface::SCOPE_STORE
        );
    }
}
