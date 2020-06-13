<?php
/**
 * FauxTwigExtension for Craft CMS 3.x
 *
 * This is intended to be used with the Symfony Plugin for PhpStorm:
 * https://plugins.jetbrains.com/plugin/7219-symfony-plugin
 *
 * It will provide full auto-complete for craft.app. and and many other useful things
 * in your Twig templates.
 *
 * Place the file somewhere in your project or include it via PhpStorm Settings -> Include Path.
 * You never call it, it's never included anywhere via PHP directly nor does it affect other
 * classes or Twig in any way. But PhpStorm will index it, and think all those variables
 * are in every single template and thus allows you to use Intellisense auto completion.
 *
 * Thanks to Robin Schambach; for context, see:
 * https://github.com/Haehnchen/idea-php-symfony2-plugin/issues/1103
 *
 * @link      https://nystudio107.com
 * @copyright Copyright (c) 2019 nystudio107
 */

namespace nystudio107\craft;

//use craft\commerce\elements\Order;
//use craft\commerce\elements\Product;
//use craft\commerce\elements\Variant;
//use craft\commerce\models\LineItem;
//use craft\commerce\Plugin;
use craft\elements\Asset;
use craft\elements\Category;
use craft\elements\db\EntryQuery;
use craft\elements\Entry;
use craft\elements\GlobalSet;
use craft\elements\MatrixBlock;
use craft\elements\Tag;
use craft\elements\User;
use craft\models\Site;
use craft\web\twig\variables\CraftVariable;
use craft\web\view;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

/**
 * @author    nystudio107
 * @package   FauxTwigExtension
 * @since     1.0.0
 */
class FauxTwigExtension extends AbstractExtension implements GlobalsInterface
{
    public function getGlobals(): array
    {
        return [
            // Craft Variable
            'craft' => new CraftVariable(),
            // Craft Elements
            'element' => new Entry(),
            'asset' => new Asset(),
            'block' => new MatrixBlock(),
            'image' => new Asset(),
            'category' => new Category(),
            'tag' => new Tag(),
            'entry' => new Entry(),
            'siteInfo' => new GlobalSet(),
            'siteNavigation' => new GlobalSet(),
            // Misc. Craft globals
            'currentUser' => new User(),
            'currentSite' => new Site(),
            'site' => new Site(),
            'view' => new view(),

            // Commerce Elements
            //'lineItem' => new LineItem(),
            //'order' => new Order(),
            //'product' => new Product(),
            //'variant' => new Variant(),
            //'commerce' => new Plugin(),

            // Project specific global variables
            'global_featuredImage' => '',
            'global_titleButtonsTargets' => new EntryQuery(),
            'global_title' => '',
            'global_navCondition' => [],
            'global_siteName' => '',
            'global_siteIcon' => new Asset()

            // Third party globals
            //'seomatic' => new \nystudio107\seomatic\variables\SeomaticVariable(),
        ];
    }
}
