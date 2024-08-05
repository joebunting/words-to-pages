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
    const pageToWordSimpleCalculator = $('#page-to-word-simple-calculator');
    // const pageToWordAdvancedCalculator = $('#page-to-word-advanced-calculator'); // Commented out

    function showCalculator(calculator) {
        simpleCalculator.addClass('hidden');
        advancedCalculator.addClass('hidden');
        analyzerCalculator.addClass('hidden');
        pageToWordSimpleCalculator.addClass('hidden');
        // pageToWordAdvancedCalculator.addClass('hidden'); // Commented out
        calculator.removeClass('hidden');
    }

    if (type === 'simple') {
        showCalculator(simpleCalculator);
        radios.closest('label').hide(); // Hide radio buttons
    } else if (type === 'advanced') {
        showCalculator(advancedCalculator);
        radios.closest('label').hide(); // Hide radio buttons
    } else if (type === 'analyzer') {
        showCalculator(analyzerCalculator);
        radios.closest('label').hide(); // Hide radio buttons
    } else if (type === 'page-to-word-simple') {
        showCalculator(pageToWordSimpleCalculator);
        radios.closest('label').hide();
    // } else if (type === 'page-to-word-advanced') { // Commented out
    //     showCalculator(pageToWordAdvancedCalculator); // Commented out
    //     radios.closest('label').hide(); // Hide radio buttons
    } else {
        radios.on('change', function() {
            const calculators = {
                'word-to-page-simple': simpleCalculator,
                'word-to-page-advanced': advancedCalculator,
                'page-to-word-simple': pageToWordSimpleCalculator,
                // 'page-to-word-advanced': pageToWordAdvancedCalculator, // Commented out
                'analyzer': analyzerCalculator
            };

            Object.values(calculators).forEach(calc => calc.addClass('hidden'));
            calculators[this.value].removeClass('hidden');
        });
    }

    $('#w2p-calculate-page-to-word-simple').on('click', function() {
        var pageCount = $('#w2p-page-count-simple').val();
        var wordsPerPage = $('#w2p-words-per-page-simple').val() || 250;
        var wordCount = pageCount * wordsPerPage;
        $('#w2p-result-page-to-word-simple').html('<p><i class="fas fa-file-alt"></i> Estimated word count: ' + wordCount + '</p>');
        $('#w2p-result-page-to-word-simple').closest('.result-box').show();
    });

    // $('#w2p-calculate-page-to-word-advanced').on('click', function() { // Commented out
    //     const pageCount = parseInt($('#w2p-page-count-adv').val()); // Commented out
    //     const pageSize = $('#w2p-page-size-ptw').val(); // Commented out
    //     const fontSize = parseFloat($('#w2p-font-size-ptw').val()); // Commented out
    //     const lineHeight = parseFloat($('#w2p-line-height-ptw').val()); // Commented out
    //     const margins = parseFloat($('#w2p-margins-ptw').val()); // Commented out

    //     const result = calculateWordCount(pageCount, pageSize, fontSize, lineHeight, margins); // Commented out

    //     $('#w2p-result-page-to-word-advanced').html( // Commented out
    //         `<p><i class="fas fa-file-alt"></i> Estimated word count: ${result.wordCount}</p>` + // Commented out
    //         `<p><i class="fas fa-sort-alpha-down"></i> Average words per page: ${result.wordsPerPage}</p>` // Commented out
    //     ); // Commented out
    //     $('#w2p-result-page-to-word-advanced').closest('.result-box').show(); // Commented out
    // });

    function calculateWordCount(pageCount, pageSize, fontSize, lineHeight, margins) {
        const [pageWidth, pageHeight] = pageSize.split('x').map(dim => parseFloat(dim));
        const usableWidth = pageWidth - 2 * margins;
        const usableHeight = pageHeight - 2 * margins;

        // Adjust CPI based on font size
        const cpi = 15 - (fontSize - 12) * 0.6;

        const charsPerLine = Math.floor(usableWidth * cpi);
        const wordsPerLine = charsPerLine / 5.5; // Assuming average word length of 4.5 chars + 1 space

        const lineHeightInches = (fontSize / 72) * lineHeight;
        const linesPerPage = Math.floor(usableHeight / lineHeightInches);

        // Adjust the factor based on line height
        const adjustmentFactor = lineHeight <= 1.2 ? 0.97 : 0.95;

        const wordsPerPage = Math.round(wordsPerLine * linesPerPage * adjustmentFactor);
        const wordCount = Math.round(pageCount * wordsPerPage);

        return {
            wordCount: wordCount,
            wordsPerPage: wordsPerPage
        };
    }

    // Hide result boxes initially
    $('.result-box').hide();

    $('#w2p-calculate-simple').on('click', function() {
        var wordCount = $('#w2p-word-count').val();
        var wordsPerPage = $('#w2p-words-per-page').val() || 250;
        var pageCount = Math.ceil(wordCount / wordsPerPage);
        $('#w2p-result-simple').html('<p><i class="fas fa-book-open"></i> Estimated page count: ' + pageCount + '</p>');
        $('#w2p-result-simple').closest('.result-box').show();
    });

    function calculatePageCount(wordCount, pageSize, fontSize, lineHeight, margins) {
        const [pageWidth, pageHeight] = pageSize.split('x').map(dim => parseFloat(dim));
        const usableWidth = pageWidth - 2 * margins;
        const usableHeight = pageHeight - 2 * margins;

        // Adjust CPI based on font size
        const cpi = 15 - (fontSize - 12) * 0.6;

        const charsPerLine = Math.floor(usableWidth * cpi);
        const wordsPerLine = charsPerLine / 5.5; // Assuming average word length of 4.5 chars + 1 space

        const lineHeightInches = (fontSize / 72) * lineHeight;
        const linesPerPage = Math.floor(usableHeight / lineHeightInches);

        // Adjust the factor based on line height
        const adjustmentFactor = lineHeight <= 1.2 ? 0.97 : 0.95;

        const wordsPerPage = Math.round(wordsPerLine * linesPerPage * adjustmentFactor);
        const pageCount = Math.ceil(wordCount / wordsPerPage);

        return {
            pageCount: pageCount,
            wordsPerPage: wordsPerPage
        };
    }

    $('#w2p-calculate-advanced').on('click', function() {
        const wordCount = parseInt($('#w2p-word-count-adv').val());
        const pageSize = $('#w2p-page-size').val();
        const fontSize = parseFloat($('#w2p-font-size').val());
        const lineHeight = parseFloat($('#w2p-line-height').val());
        const margins = parseFloat($('#w2p-margins').val());

        const result = calculatePageCount(wordCount, pageSize, fontSize, lineHeight, margins);

        $('#w2p-result-advanced').html(
            `<p><i class="fas fa-book-open"></i> Estimated page count: ${result.pageCount}</p>` +
            `<p><i class="fas fa-sort-alpha-down"></i> Average words per page: ${result.wordsPerPage}</p>`
        );
        $('#w2p-result-advanced').closest('.result-box').show();
    });

    $('#w2p-analyze-text').on('click', function() {
        var text = $('#w2p-text-input').val();
        var wordCount = text.trim().split(/\s+/).length;
        var pageCount = Math.ceil(wordCount / 250);
        const progressPercentage = Math.min(100, Math.round((wordCount / 50000) * 100));
        $('#w2p-text-result').html(
            `<div class="progress-circle" data-value="${progressPercentage}" style="background: conic-gradient(#4682b4 ${progressPercentage * 3.6}deg, #f0f8ff 0deg);"></div>` +
            `<p><i class="fas fa-book-open"></i> Word count: ${wordCount}</p>` +
            `<p><i class="fas fa-file-alt"></i> Estimated page count: ${pageCount}</p>`
        );
        $('#w2p-text-result').closest('.result-box').show();
    });
});