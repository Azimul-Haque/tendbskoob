<?php

declare(strict_types=1);

namespace PackageVersions;

use Composer\InstalledVersions;
use OutOfBoundsException;

class_exists(InstalledVersions::class);

/**
 * This class is generated by composer/package-versions-deprecated, specifically by
 * @see \PackageVersions\Installer
 *
 * This file is overwritten at every run of `composer install` or `composer update`.
 *
 * @deprecated in favor of the Composer\InstalledVersions class provided by Composer 2. Require composer-runtime-api:^2 to ensure it is present.
 */
final class Versions
{
    /**
     * @deprecated please use {@see self::rootPackageName()} instead.
     *             This constant will be removed in version 2.0.0.
     */
    const ROOT_PACKAGE_NAME = 'laravel/laravel';

    /**
     * Array of all available composer packages.
     * Dont read this array from your calling code, but use the \PackageVersions\Versions::getVersion() method instead.
     *
     * @var array<string, string>
     * @internal
     */
    const VERSIONS          = array (
  'barryvdh/laravel-dompdf' => 'v0.8.7@30310e0a675462bf2aa9d448c8dcbf57fbcc517d',
  'box/spout' => 'v3.3.0@9bdb027d312b732515b884a341c0ad70372c6295',
  'brian2694/laravel-toastr' => '5.56@98137445f55d981f3587800349f1aa7b045d7974',
  'ckeditor/ckeditor' => '4.17.1@b71b8bf724174f2feaf53f64ee424bf1f5ba61fa',
  'composer/package-versions-deprecated' => '1.11.99.4@b174585d1fe49ceed21928a945138948cb394600',
  'defuse/php-encryption' => 'v2.3.1@77880488b9954b7884c25555c2a0ea9e7053f9d2',
  'doctrine/cache' => '2.1.1@331b4d5dbaeab3827976273e9356b3b453c300ce',
  'doctrine/dbal' => '2.13.6@67ef6d0327ccbab1202b39e0222977a47ed3ef2f',
  'doctrine/deprecations' => 'v0.5.3@9504165960a1f83cc1480e2be1dd0a0478561314',
  'doctrine/event-manager' => '1.1.1@41370af6a30faa9dc0368c4a6814d596e81aba7f',
  'doctrine/inflector' => '2.0.4@8b7ff3e4b7de6b2c84da85637b59fd2880ecaa89',
  'doctrine/lexer' => '1.2.1@e864bbf5904cb8f5bb334f99209b48018522f042',
  'dompdf/dompdf' => 'v0.8.6@db91d81866c69a42dad1d2926f61515a1e3f42c5',
  'dragonmantank/cron-expression' => 'v2.3.1@65b2d8ee1f10915efb3b55597da3404f096acba2',
  'egulias/email-validator' => '2.1.25@0dbf5d78455d4d6a41d186da50adc1122ec066f4',
  'fideloper/proxy' => '4.4.1@c073b2bd04d1c90e04dc1b787662b558dd65ade0',
  'firebase/php-jwt' => 'v5.5.1@83b609028194aa042ea33b5af2d41a7427de80e6',
  'guzzlehttp/guzzle' => '6.5.5@9d4290de1cfd701f38099ef7e183b64b4b7b0c5e',
  'guzzlehttp/promises' => '1.5.1@fe752aedc9fd8fcca3fe7ad05d419d32998a06da',
  'guzzlehttp/psr7' => '1.8.3@1afdd860a2566ed3c2b0b4a3de6e23434a79ec85',
  'intervention/image' => '2.7.1@744ebba495319501b873a4e48787759c72e3fb8c',
  'laravel/framework' => 'v6.20.42@251e09a2ecf41241b9892fe490eb301d5c9721b9',
  'laravel/passport' => 'v7.5.1@d63cdd672c3d65b3c35b73d0ef13a9dbfcb71c08',
  'laravel/socialite' => 'v5.2.6@b5c67f187ddcf15529ff7217fa735b132620dfac',
  'laravel/tinker' => 'v2.6.3@a9ddee4761ec8453c584e393b393caff189a3e42',
  'laravelpkg/laravelchk' => 'dev-master@f60183a9394caae3819c563960feca20c072efe0',
  'lcobucci/jwt' => '3.3.3@c1123697f6a2ec29162b82f170dd4a491f524773',
  'league/commonmark' => '1.6.6@c4228d11e30d7493c6836d20872f9582d8ba6dcf',
  'league/event' => '2.2.0@d2cc124cf9a3fab2bb4ff963307f60361ce4d119',
  'league/flysystem' => '1.1.8@c995bb0c23c58c9813d081f9523c9b7bb496698e',
  'league/mime-type-detection' => '1.9.0@aa70e813a6ad3d1558fc927863d47309b4c23e69',
  'league/oauth1-client' => 'v1.10.0@88dd16b0cff68eb9167bfc849707d2c40ad91ddc',
  'league/oauth2-server' => '7.4.0@2eb1cf79e59d807d89c256e7ac5e2bf8bdbd4acf',
  'madnest/madzipper' => 'v1.1.0@fd1d8199d04eac103eed9355c9bba680dcf8b89b',
  'maherelgamil/laravel-fawry' => 'v0.1.1@2a6f3f3873baf668ae14daa9ddab8374d1aeffbf',
  'monolog/monolog' => '2.3.5@fd4380d6fc37626e2f799f29d91195040137eba9',
  'mpdf/mpdf' => 'v8.0.15@d8a5294a6cc2e814c4157aecc8d7ac25014b18ed',
  'myclabs/deep-copy' => '1.10.2@776f831124e9c62e1a2c601ecc52e776d8bb7220',
  'nesbot/carbon' => '2.55.2@8c2a18ce3e67c34efc1b29f64fe61304368259a2',
  'nexmo/laravel' => '2.4.1@029bdc19fc58cd6ef0aa75c7041d82b9d9dc61bd',
  'nikic/php-parser' => 'v4.13.2@210577fe3cf7badcc5814d99455df46564f3c077',
  'opis/closure' => '3.6.2@06e2ebd25f2869e54a306dda991f7db58066f7f6',
  'paragonie/random_compat' => 'v9.99.100@996434e5492cb4c3edcb9168db6fbb1359ef965a',
  'paypal/rest-api-sdk-php' => '1.14.0@72e2f2466975bf128a31e02b15110180f059fc04',
  'phenx/php-font-lib' => '0.5.2@ca6ad461f032145fff5971b5985e5af9e7fa88d8',
  'phenx/php-svg-lib' => 'v0.3.3@5fa61b65e612ce1ae15f69b3d223cb14ecc60e32',
  'php-http/guzzle6-adapter' => 'v2.0.2@9d1a45eb1c59f12574552e81fb295e9e53430a56',
  'php-http/httplug' => '2.2.0@191a0a1b41ed026b717421931f8d3bd2514ffbf9',
  'php-http/promise' => '1.1.0@4c4c1f9b7289a2ec57cde7f1e9762a5789506f88',
  'phpoption/phpoption' => '1.8.1@eab7a0df01fe2344d172bff4cd6dbd3f8b84ad15',
  'phpseclib/phpseclib' => '2.0.35@4e16cf3f5f927a7d3f5317820af795c0366c0420',
  'psr/container' => '1.1.1@8622567409010282b7aeebe4bb841fe98b58dcaf',
  'psr/http-client' => '1.0.1@2dfb5f6c5eff0e91e20e913f8c5452ed95b86621',
  'psr/http-factory' => '1.0.1@12ac7fcd07e5b077433f5f2bee95b3a771bf61be',
  'psr/http-message' => '1.0.1@f6561bf28d520154e4b0ec72be95418abe6d9363',
  'psr/log' => '1.1.4@d49695b909c3b7628b6289db5479a1c204601f11',
  'psr/simple-cache' => '1.0.1@408d5eafb83c57f6365a3ca330ff23aa4a5fa39b',
  'psy/psysh' => 'v0.10.12@a0d9981aa07ecfcbea28e4bfa868031cca121e7d',
  'ralouphie/getallheaders' => '3.0.3@120b605dfeb996808c31b6477290a714d356e822',
  'ramsey/uuid' => '3.9.6@ffa80ab953edd85d5b6c004f96181a538aad35a3',
  'rap2hpoutre/fast-excel' => 'v3.1.0@01e309600b2ead458ce0d4399c70746677b08cca',
  'razorpay/razorpay' => '2.8.1@4ad7b6a5bd9896305858ec0a861f66020e39f628',
  'rmccue/requests' => 'v1.8.0@afbe4790e4def03581c4a0963a1e8aa01f6030f1',
  'sabberworm/php-css-parser' => '8.3.1@d217848e1396ef962fb1997cf3e2421acba7f796',
  'setasign/fpdi' => 'v2.3.6@6231e315f73e4f62d72b73f3d6d78ff0eed93c31',
  'stripe/stripe-php' => 'v7.105.0@3a926610ca772aa7519fb132c88a6e7472788d90',
  'swiftmailer/swiftmailer' => 'v6.3.0@8a5d5072dca8f48460fce2f4131fcc495eec654c',
  'symfony/console' => 'v4.4.34@329b3a75cc6b16d435ba1b1a41df54a53382a3f0',
  'symfony/css-selector' => 'v5.4.0@44b933f98bb4b5220d10bed9ce5662f8c2d13dcc',
  'symfony/debug' => 'v4.4.31@43ede438d4cb52cd589ae5dc070e9323866ba8e0',
  'symfony/deprecation-contracts' => 'v2.5.0@6f981ee24cf69ee7ce9736146d1c57c2780598a8',
  'symfony/error-handler' => 'v4.4.34@17785c374645def1e884d8ec49976c156c61db4d',
  'symfony/event-dispatcher' => 'v4.4.34@1a024b45369c9d55d76b6b8a241bd20c9ea1cbd8',
  'symfony/event-dispatcher-contracts' => 'v1.1.11@01e9a4efac0ee33a05dfdf93b346f62e7d0e998c',
  'symfony/finder' => 'v4.4.30@70362f1e112280d75b30087c7598b837c1b468b6',
  'symfony/http-client-contracts' => 'v2.5.0@ec82e57b5b714dbb69300d348bd840b345e24166',
  'symfony/http-foundation' => 'v4.4.34@f4cbbb6fc428588ce8373802461e7fe84e6809ab',
  'symfony/http-kernel' => 'v4.4.35@fb793f1381c34b79a43596a532a6a49bd729c9db',
  'symfony/mime' => 'v5.4.0@d4365000217b67c01acff407573906ff91bcfb34',
  'symfony/polyfill-ctype' => 'v1.23.0@46cd95797e9df938fdd2b03693b5fca5e64b01ce',
  'symfony/polyfill-iconv' => 'v1.23.0@63b5bb7db83e5673936d6e3b8b3e022ff6474933',
  'symfony/polyfill-intl-idn' => 'v1.23.0@65bd267525e82759e7d8c4e8ceea44f398838e65',
  'symfony/polyfill-intl-normalizer' => 'v1.23.0@8590a5f561694770bdcd3f9b5c69dde6945028e8',
  'symfony/polyfill-mbstring' => 'v1.23.1@9174a3d80210dca8daa7f31fec659150bbeabfc6',
  'symfony/polyfill-php72' => 'v1.23.0@9a142215a36a3888e30d0a9eeea9766764e96976',
  'symfony/polyfill-php73' => 'v1.23.0@fba8933c384d6476ab14fb7b8526e5287ca7e010',
  'symfony/polyfill-php80' => 'v1.23.1@1100343ed1a92e3a38f9ae122fc0eb21602547be',
  'symfony/process' => 'v4.4.35@c2098705326addae6e6742151dfade47ac71da1b',
  'symfony/psr-http-message-bridge' => 'v1.3.0@9d3e80d54d9ae747ad573cad796e8e247df7b796',
  'symfony/routing' => 'v4.4.34@fc9dda0c8496f8ef0a89805c2eabfc43b8cef366',
  'symfony/service-contracts' => 'v2.5.0@1ab11b933cd6bc5464b08e81e2c5b07dec58b0fc',
  'symfony/translation' => 'v4.4.34@26d330720627b234803595ecfc0191eeabc65190',
  'symfony/translation-contracts' => 'v2.5.0@d28150f0f44ce854e942b671fc2620a98aae1b1e',
  'symfony/var-dumper' => 'v4.4.34@2d0c056b2faaa3d785bdbd5adecc593a5be9c16e',
  'tijsverkoyen/css-to-inline-styles' => '2.2.3@b43b05cf43c1b6d849478965062b6ef73e223bb5',
  'twilio/sdk' => '6.31.2@be59275f0fc311cb45d5303d47bffaa06a19d6e5',
  'unicodeveloper/laravel-paystack' => '1.0.7@bfcb92255c29d92b0c4e80355a65de14e2e156f3',
  'vlucas/phpdotenv' => 'v3.6.9@a1bf4c9853d90ade427b4efe35355fc41b3d6988',
  'vonage/client' => '2.3.0@e9c1492a9f1572124143e6fa963da417bb20d9ae',
  'vonage/client-core' => '2.1.0@ef7e8a0715c93c5ddc7915e8a29f29331798bb52',
  'zendframework/zend-diactoros' => '2.2.1@de5847b068362a88684a55b0dbb40d85986cfa52',
  'amirami/localizator' => 'v0.6.1-alpha@51a0cc48dc927666cdc7837849b5dbf82d32b7cb',
  'barryvdh/laravel-debugbar' => 'v3.6.4@3c2d678269ba60e178bcd93e36f6a91c36b727f1',
  'doctrine/instantiator' => '1.4.0@d56bf6102915de5702778fe20f2de3b2fe570b5b',
  'facade/flare-client-php' => '1.9.1@b2adf1512755637d0cef4f7d1b54301325ac78ed',
  'facade/ignition' => '1.18.0@fca0cbe5f900f94773d821b481c16d4ea3503491',
  'facade/ignition-contracts' => '1.0.2@3c921a1cdba35b68a7f0ccffc6dffc1995b18267',
  'filp/whoops' => '2.14.4@f056f1fe935d9ed86e698905a957334029899895',
  'fzaninotto/faker' => 'v1.9.2@848d8125239d7dbf8ab25cb7f054f1a630e68c2e',
  'hamcrest/hamcrest-php' => 'v2.0.1@8c3d0a3f6af734494ad8f6fbbee0ba92422859f3',
  'laravel/ui' => 'v1.3.0@21dc7e58896db977aad246e710b4810aaab9a968',
  'maximebf/debugbar' => 'v1.17.3@e8ac3499af0ea5b440908e06cc0abe5898008b3c',
  'mockery/mockery' => '1.4.4@e01123a0e847d52d186c5eb4b9bf58b0c6d00346',
  'nunomaduro/collision' => 'v3.2.0@f7c45764dfe4ba5f2618d265a6f1f9c72732e01d',
  'phar-io/manifest' => '2.0.3@97803eca37d319dfa7826cc2437fc020857acb53',
  'phar-io/version' => '3.1.0@bae7c545bef187884426f042434e561ab1ddb182',
  'php-parallel-lint/php-console-color' => 'v0.3@b6af326b2088f1ad3b264696c9fd590ec395b49e',
  'php-parallel-lint/php-console-highlighter' => 'v0.5@21bf002f077b177f056d8cb455c5ed573adfdbb8',
  'phpdocumentor/reflection-common' => '2.2.0@1d01c49d4ed62f25aa84a747ad35d5a16924662b',
  'phpdocumentor/reflection-docblock' => '5.3.0@622548b623e81ca6d78b721c5e029f4ce664f170',
  'phpdocumentor/type-resolver' => '1.5.1@a12f7e301eb7258bb68acd89d4aefa05c2906cae',
  'phpspec/prophecy' => '1.14.0@d86dfc2e2a3cd366cee475e52c6bb3bbc371aa0e',
  'phpunit/php-code-coverage' => '7.0.15@819f92bba8b001d4363065928088de22f25a3a48',
  'phpunit/php-file-iterator' => '2.0.5@42c5ba5220e6904cbfe8b1a1bda7c0cfdc8c12f5',
  'phpunit/php-text-template' => '1.2.1@31f8b717e51d9a2afca6c9f046f5d69fc27c8686',
  'phpunit/php-timer' => '2.1.3@2454ae1765516d20c4ffe103d85a58a9a3bd5662',
  'phpunit/php-token-stream' => '4.0.4@a853a0e183b9db7eed023d7933a858fa1c8d25a3',
  'phpunit/phpunit' => '8.5.21@50a58a60b85947b0bee4c8ecfe0f4bbdcf20e984',
  'scrivo/highlight.php' => 'v9.18.1.8@6d5049cd2578e19a06adbb6ac77879089be1e3f9',
  'sebastian/code-unit-reverse-lookup' => '1.0.2@1de8cd5c010cb153fcd68b8d0f64606f523f7619',
  'sebastian/comparator' => '3.0.3@1071dfcef776a57013124ff35e1fc41ccd294758',
  'sebastian/diff' => '3.0.3@14f72dd46eaf2f2293cbe79c93cc0bc43161a211',
  'sebastian/environment' => '4.2.4@d47bbbad83711771f167c72d4e3f25f7fcc1f8b0',
  'sebastian/exporter' => '3.1.4@0c32ea2e40dbf59de29f3b49bf375176ce7dd8db',
  'sebastian/global-state' => '3.0.1@474fb9edb7ab891665d3bfc6317f42a0a150454b',
  'sebastian/object-enumerator' => '3.0.4@e67f6d32ebd0c749cf9d1dbd9f226c727043cdf2',
  'sebastian/object-reflector' => '1.1.2@9b8772b9cbd456ab45d4a598d2dd1a1bced6363d',
  'sebastian/recursion-context' => '3.0.1@367dcba38d6e1977be014dc4b22f47a484dac7fb',
  'sebastian/resource-operations' => '2.0.2@31d35ca87926450c44eae7e2611d45a7a65ea8b3',
  'sebastian/type' => '1.1.4@0150cfbc4495ed2df3872fb31b26781e4e077eb4',
  'sebastian/version' => '2.0.1@99732be0ddb3361e16ad77b68ba41efc8e979019',
  'theseer/tokenizer' => '1.2.1@34a41e998c2183e22995f158c581e7b5e755ab9e',
  'webmozart/assert' => '1.10.0@6964c76c7804814a842473e0c8fd15bab0f18e25',
  'laravel/laravel' => 'dev-master@81c98c76d12da04989bbd8b25cb9d2763b2ad819',
);

    private function __construct()
    {
    }

    /**
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function rootPackageName() : string
    {
        if (!self::composer2ApiUsable()) {
            return self::ROOT_PACKAGE_NAME;
        }

        return InstalledVersions::getRootPackage()['name'];
    }

    /**
     * @throws OutOfBoundsException If a version cannot be located.
     *
     * @psalm-param key-of<self::VERSIONS> $packageName
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function getVersion(string $packageName): string
    {
        if (self::composer2ApiUsable()) {
            return InstalledVersions::getPrettyVersion($packageName)
                . '@' . InstalledVersions::getReference($packageName);
        }

        if (isset(self::VERSIONS[$packageName])) {
            return self::VERSIONS[$packageName];
        }

        throw new OutOfBoundsException(
            'Required package "' . $packageName . '" is not installed: check your ./vendor/composer/installed.json and/or ./composer.lock files'
        );
    }

    private static function composer2ApiUsable(): bool
    {
        if (!class_exists(InstalledVersions::class, false)) {
            return false;
        }

        if (method_exists(InstalledVersions::class, 'getAllRawData')) {
            $rawData = InstalledVersions::getAllRawData();
            if (count($rawData) === 1 && count($rawData[0]) === 0) {
                return false;
            }
        } else {
            $rawData = InstalledVersions::getRawData();
            if ($rawData === null || $rawData === []) {
                return false;
            }
        }

        return true;
    }
}
