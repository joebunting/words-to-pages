jQuery(document).ready(function($) {
    $('#wpc-calculate-simple').on('click', function() {
        var wordCount = $('#wpc-word-count').val();
        var wordsPerPage = $('#wpc-words-per-page').val() || 250;
        var pageCount = Math.ceil(wordCount / wordsPerPage);
        $('#wpc-result-simple').text('Estimated page count: ' + pageCount);
    });

    $('#wpc-calculate-advanced').on('click', function() {
        var wordCount = $('#wpc-word-count-adv').val();
        var pageSize = $('#wpc-page-size').val();
        var fontSize = $('#wpc-font-size').val();
        var lineHeight = $('#wpc-line-height').val();
        
        // This calculation should match the PHP function
        var wordsPerLine = Math.floor(pageSize / fontSize);
        var linesPerPage = Math.floor(pageSize / lineHeight);
        var wordsPerPage = wordsPerLine * linesPerPage;
        var pageCount = Math.ceil(wordCount / wordsPerPage);
        
        $('#wpc-result-advanced').text('Estimated page count: ' + pageCount);
    });

    $('#wpc-analyze-text').on('click', function() {
        var text = $('#wpc-text-input').val();
        var wordCount = text.trim().split(/\s+/).length;
        var pageCount = Math.ceil(wordCount / 250);
        $('#wpc-text-result').text('Word count: ' + wordCount + ', Estimated page count: ' + pageCount);
    });
});