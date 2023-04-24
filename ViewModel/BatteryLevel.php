<?php

/**
 * Copyright © Rob Aimes - https://aimes.dev/
 * https://github.com/robaimes
 */

namespace Aimes\NativeExperience\ViewModel;

use Aimes\NativeExperience\Scope\Config;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Customer\Model\SessionFactory as CustomerSessionFactory;
use Magento\Customer\Model\Url as CustomerUrl;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class BatteryLevel implements ArgumentInterface
{
    /** @var Config */
    private Config $config;

    /** @var CustomerSessionFactory */
    private CustomerSessionFactory $customerSessionFactory;

    /** @var CustomerUrl */
    private CustomerUrl $customerUrl;

    /**
     * @param Config $config
     * @param CustomerSessionFactory $customerSessionFactory
     * @param CustomerUrl $customerUrl
     */
    public function __construct(
        Config $config,
        CustomerSessionFactory $customerSessionFactory,
        CustomerUrl $customerUrl
    ) {
        $this->config = $config;
        $this->customerSessionFactory = $customerSessionFactory;
        $this->customerUrl = $customerUrl;
    }

    /**
     * Get message to be displayed when a guest's battery level is low
     *
     * @return string
     */
    public function getGuestBatteryMessage(): string
    {
        return __(
            'Your device battery level is getting low. By <a href="%1">creating an account</a> you can save your cart contents for later.',
            $this->customerUrl->getRegisterUrl()
        );
    }

    /**
     * Check if customer is authenticated / logged in
     *
     * @return bool
     */
    public function isCustomerLoggedIn(): bool
    {
        /** @var CustomerSession $session */
        $customerSession = $this->customerSessionFactory->create();

        return $customerSession->isLoggedIn();
    }
}
