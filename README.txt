Drupal Theme based on the YAML css Framework

---+ Introduction

This theme is build to implement and utilize the yaml css framework that way, that it is easily usable with Drupal. 
This theme is not build to be used directly, as the more know one like Garland or similar. This theme is similar to the Drupal base theme Zen. It should be used to be able to build your onw theme very fast and flexible.

---+ Features
 * Implements different Layouts: 1Col, 31 Col right(2col), 13 Col left(2col), 123 Col (3Col) 
  * You can chose your layout in the Theme-Settings, without any code
  * All layouts are build on the same page.tpl.php and are therefor highly maintainable. You can define your own page.tpl.php for layout using page-LAYOUT.tpl.php
 * Choose your page width in the Theme-Settings
  * You dont need any CSS for that, just chose it using a procentual or fix value like 80% or 960px
 * Chose your Font-Size in the Theme-Settings 
 * Chose to hide or show the general Drupal header (Theme, Page-Name, Slogan)
 * Chose to hide or show the general Drupal local tasks
 * You can switch your layout in runtime e.g. for rendering a specific node or view using a special hook
 * Subtheme and SubSubTheme CSS files are included in the correct order. Overriding is made easy without "extra specific selectors"
 * the yaml package and the drupal yaml mods are seperated in different dircories (yaml and yaml_drupal). You can therefor upgrade your yaml-framework anytime. No hacks.
 
---+ Installation
 * Download the theme and put it under sites/all/theme/yaml_theme
 * Download the yaml-css framwork package from http://www.yaml.de/en/download.html and put it under yaml_theme/yaml
  * You must extract it that way, that the yaml_theme/yaml/core folder exists
  * Check the licence! You can use yaml for free if you put a note in the impressum that you use yaml-css-framework (with a link to the homepage) 
  

---+ Documentation
Most of the documentation you need is on the YAML CSS Framwork homepage ( http://www.yaml.de/en/home.html ). But there are still some things you might need to know about this theme

---++ How can i build themes (Subthemes)
Well the best sources to answer this question are the drupal docs, as this is out of scope for this document
 * General Guide: http://drupal.org/theme-guide
 * Subthemes : http://drupal.org/node/225125
 
---++ How to override CCS Settings of yaml in my subtheme?
Just include a css-file in the yourtheme.module like this:
stylesheets[all][] = css/yourstyles.css
Create that file under the subfoledr css/ and then add the styles. You *dont* need to add any extra selectors to override, this is handled by the inclusion order. 
So e.g. for overriding <i>#col3 .subcolumn h2 {}</i> you dont need to be more specific like <i>body #col3 .subcolumn h2 {}</i>. Simply use
<i>#col3 .subcolumn h2 {}</i> in your css file, it will be handled properly

---++ How to switch the layout of the page durin runtime
You can switch you site layout during render time, so for specific nodes or views or whereever you like. For this purpose you need to implement this hook
 * hook_yaml_theme_layout

Example:
<code>
function drupalwiki_yaml_theme_layout($layout, $available) {
  global $theme;
  switch($theme) {
    case 'wikipedia_theme':
      if(arg(0) == 'searchplus') {
        return '2col_left_13';
      }
      if(arg(0) == 'node' and arg(1) == 14) {
        return '3col_left_132';
      }
      break;
    default:
      if(arg(0) == 'searchplus') {
        return '2col_right_31';
      }
  }
}  
</code>
So here, when the first part of the url matches 'searchplus' i switch the layout to 2col_right or 2col_left depending on the theme i use.


....
More to come
...

If you like that theme and you want to help or contribute, please let me know. Iam open to any ideas or contributions, feedback or critics.
