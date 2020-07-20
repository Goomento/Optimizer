# Goomento Optimizer 

## How to install & upgrade Goomento_Optimizer

### 1. Install via Git

Run the following command Magento 2 root folder

#### 1.1 Install

```
mkdir -f app/code/Goomento
git clone git@github.com:Goomento/Optimizer.git app/code/Goomento/
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```

#### 1.2 Upgrade

```
cd app/code/Goomento/Optimizer
git pull origin master
# Back to Magento root folder
cd ../../../../
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```

Run compile if your store in Product mode:

```
php bin/magento setup:di:compile
```

### 2. Upload the file.

You can try this way to upload the file to your server using [Filezilla](https://filezilla-project.org/)

- Download [the latest version here](https://github.com/Goomento/Optimizer/archive/master.zip) 
- Extract `Optimizer-master.zip`; 
- Upload (or copy) the file to your server (or project) under `app/code/Goomento/Optimizer`. 
You should create a folder path `app/code/Goomento/Optimizer` if not exist.
- Go to Magento 2 root folder and run upgrade command:
```
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```
Run compile if your store in Product mode:

```
php bin/magento setup:di:compile
```
