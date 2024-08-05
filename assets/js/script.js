jQuery(document).ready(function($) {
    // Display Attribution 
    if (window.location.hostname !== 'thewritepractice.com') {
        $(".twp-attribution").removeClass('hidden');
    }

    // Toggle calculators based on radio button selection
    const radios = $('input[name="w2p-type"]');
    const simpleCalculator = $('#simple-calculator');
    const advancedCalculator = $('#advanced-calculator');

    radios.on('change', function() {
        if (this.value === 'simple') {
            simpleCalculator.removeClass('hidden');
            advancedCalculator.addClass('hidden');
        } else if (this.value === 'advanced') {
            simpleCalculator.addClass('hidden');
            advancedCalculator.removeClass('hidden');
        }
    });

    $('#w2p-calculate-simple').on('click', function() {
        var wordCount = $('#w2p-word-count').val();
        var wordsPerPage = $('#w2p-words-per-page').val() || 250;
        var pageCount = Math.ceil(wordCount / wordsPerPage);
        $('#w2p-result-simple').text('Estimated page count: ' + pageCount);
    });

    $('#w2p-calculate-advanced').on('click', function() {
        var wordCount = $('#w2p-word-count-adv').val();
        var pageSize = $('#w2p-page-size').val();
        var fontSize = $('#w2p-font-size').val();
        var lineHeight = $('#w2p-line-height').val();
        
        // This calculation should match the PHP function
        var wordsPerLine = Math.floor(pageSize / fontSize);
        var linesPerPage = Math.floor(pageSize / lineHeight);
        var wordsPerPage = wordsPerLine * linesPerPage;
        var pageCount = Math.ceil(wordCount / wordsPerPage);
        
        $('#w2p-result-advanced').text('Estimated page count: ' + pageCount);
    });

    $('#w2p-analyze-text').on('click', function() {
        var text = $('#w2p-text-input').val();
        var wordCount = text.trim().split(/\s+/).length;
        var pageCount = Math.ceil(wordCount / 250);
        $('#w2p-text-result').text('Word count: ' + wordCount + ', Estimated page count: ' + pageCount);
    });
});