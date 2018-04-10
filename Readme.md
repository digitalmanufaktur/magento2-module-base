DMC Base
=====================
This is a base Modul for DMC changes

Facts
-----
- version: 1.0.0
- extension key: DMC_Base

Features
-----------
- DMC log class
- Backend configuration
- Helper to get storeConfig


Requirements
------------
- None

Compatibility
-------------
- Magento >= 2.0

Installation Instructions "Manual" Installation
---------------------------------------------
1. create a directory `app/code/DMC/Base`
2. extract all files of the module there
3. enable the module with

        bin/magento module:enable DMC_Base
        bin/magento setup:upgrade
        

Uninstallation
--------------
1. remove the directory `app/code/DMC/Base`

Usage
-----
- **Logger**
    
        <?php
        namespace YourNamespace\YourModule\Model;
        
        class MyClass
        {
        
            /**
             * @var \DMC\Base\Logger\Logger
             */
            protected $logger;
        
            /**
             * Constructor
             * @param \DMC\Base\Logger\Logger $logger
             */
            public function __construct(
                \DMC\Base\Logger\Logger $logger
            )
            {
                $this->logger = $logger;
            }
        
            
            protected function someMethod()
            {
                $this->logger->info('My message');
            }
        
        }

- **Helper**
    
    get config in phtml:
    
        $this->helper('DMC\Base\Helper\Data')->getConfigByPath('section/group/field');
        
    get config in block and helper:
        
        $this->objectManager->create('DMC\Base\Helper\Data')->getConfigByPath('section/group/field');
    
    
Authors
---------
AK <magento@digitalmanufaktur.com>

Licence
-------
[GNU General Public License, version 3 (GPLv3)](http://opensource.org/licenses/gpl-3.0)
