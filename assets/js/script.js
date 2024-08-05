jQuery(document).ready(function($) {
    // Display Attribution 
    if (window.location.hostname !== 'thewritepractice.com') {
        $(".twp-attribution").removeClass('hidden');
    }

    // Get the type from a data attribute or other method
    const type = $('#w2p-calculator-container').data('type');

    // Toggle calculators based on radio button selection
    const radios = $('input[name="w2p-type"]');
    const simpleCalculator = $('#simple-calculator');
    const advancedCalculator = $('#advanced-calculator');
    const analyzerCalculator = $('#analyzer-calculator');

    if (type === 'simple') {
        simpleCalculator.removeClass('hidden');
        advancedCalculator.addClass('hidden');
        analyzerCalculator.addClass('hidden');
        radios.closest('label').hide(); // Hide radio buttons
    } else if (type === 'advanced') {
        simpleCalculator.addClass('hidden');
        advancedCalculator.removeClass('hidden');
        analyzerCalculator.addClass('hidden');
        radios.closest('label').hide(); // Hide radio buttons
    } else if (type === 'analyzer') {
        simpleCalculator.addClass('hidden');
        advancedCalculator.addClass('hidden');
        analyzerCalculator.removeClass('hidden');
        radios.closest('label').hide(); // Hide radio buttons
    } else {
        radios.on('change', function() {
            if (this.value === 'simple') {
                simpleCalculator.removeClass('hidden');
                advancedCalculator.addClass('hidden');
                analyzerCalculator.addClass('hidden');
            } else if (this.value === 'advanced') {
                simpleCalculator.addClass('hidden');
                advancedCalculator.removeClass('hidden');
                analyzerCalculator.addClass('hidden');
            } else if (this.value === 'analyzer') {
                simpleCalculator.addClass('hidden');
                advancedCalculator.addClass('hidden');
                analyzerCalculator.removeClass('hidden');
            }
        });
    }

    $('#w2p-calculate-simple').on('click', function() {
        var wordCount = $('#w2p-word-count').val();
        var wordsPerPage = $('#w2p-words-per-page').val() || 250;
        var pageCount = Math.ceil(wordCount / wordsPerPage);
        $('#w2p-result-simple').html('<i class="fas fa-file-alt"></i> Estimated page count: ' + pageCount);
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
        
        $('#w2p-result-advanced').html('<i class="fas fa-file-alt"></i> Estimated page count: ' + pageCount);
    });

    $('#w2p-analyze-text').on('click', function() {
        var text = $('#w2p-text-input').val();
        var wordCount = text.trim().split(/\s+/).length;
        var pageCount = Math.ceil(wordCount / 250);
        $('#w2p-text-result').html('<i class="fas fa-file-alt"></i> Word count: ' + wordCount + ', Estimated page count: ' + pageCount);
    });
});