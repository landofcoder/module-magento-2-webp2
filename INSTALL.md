# Instructions for using composer
Use composer to install this extension. First make sure that Magento is installed via composer, and that there is a valid `composer.json` file present.

Next, install our module using the following command:

    composer require landofcoder/module-webp2

Next, install the new module into Magento itself:

    ./bin/magento module:enable Lof_Webp2
    ./bin/magento setup:upgrade

Enable the module by toggling the setting in **Stores > Configuration > Landofcoder > Lof WebP > Enabled**.

# Instructions for using ExtDN installer
First install the ExtDN installer:

	wget https://github.com/extdn/installer-m2/raw/master/build/extdn_installer.phar
	chmod 755 extdn_installer.phar 

We recommend moving the PHAR file to a global location like `/usr/local/bin/extdn_installer`:

    sudo mv extdn_installer.phar /usr/local/bin/extdn_installer

Next, install this extension:

	extdn_installer install landofcoder/module-webp2

Done.

