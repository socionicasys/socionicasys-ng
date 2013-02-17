<?php $this->beginContent('//layouts/full'); ?>
<article <?php echo $this->contentAttr; ?>>
    <div id="google_translate_element"></div>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'ru',
                includedLanguages: 'en',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                autoDisplay: false,
                gaTrack: true,
                gaId: 'UA-8823766-1'}, 'google_translate_element'
            );
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
	<?php echo $content; ?>
</article>
<?php $this->endContent();
