<script>
    $(document).ready(function() {
        $('.userselectize').selectize();

        var $gridButton = $('.grid-view-button');
        var $gridView = $('#gridView');
        var $listButton = $('.list-view-button');
        var $listView = $('#listView');
<<<<<<< HEAD
        var $customTitle = $('#customTitle');
        var $customTitleOptions = $('#customTitleOptions');

        var customTitleSearch = $customTitle.val() == 'custom';
=======
>>>>>>> Cylunny/extension/polls-and-forms

        var view = null;

        initView();
<<<<<<< HEAD
        updateTitleSearch();


        $customTitle.on('change', function(e) {
            customTitleSearch = $customTitle.val() == 'custom';

            updateTitleSearch();
        });

        function updateTitleSearch() {
            if (customTitleSearch) $customTitleOptions.removeClass('hide');
            else $customTitleOptions.addClass('hide');
        }
=======
>>>>>>> Cylunny/extension/polls-and-forms

        $gridButton.on('click', function(e) {
            e.preventDefault();
            setView('grid');
        });
        $listButton.on('click', function(e) {
            e.preventDefault();
            setView('list');
        });

<<<<<<< HEAD
        function initView() {
            view = window.localStorage.getItem('lorekeeper_masterlist_view');
            if (!view) view = 'grid';
            setView(view);
        }

        function setView(status) {
            view = status;

            if (view == 'grid') {
=======
        function initView()
        {
            view = window.localStorage.getItem('lorekeeper_masterlist_view');
            if(!view) view = 'grid';
            setView(view);
        }

        function setView(status)
        {
            view = status;

            if(view == 'grid') {
>>>>>>> Cylunny/extension/polls-and-forms
                $gridView.removeClass('hide');
                $gridButton.addClass('active');
                $listView.addClass('hide');
                $listButton.removeClass('active');
                window.localStorage.setItem('lorekeeper_masterlist_view', 'grid');
<<<<<<< HEAD
            } else if (view == 'list') {
=======
            }
            else if (view == 'list') {
>>>>>>> Cylunny/extension/polls-and-forms
                $listView.removeClass('hide');
                $listButton.addClass('active');
                $gridView.addClass('hide');
                $gridButton.removeClass('active');
                window.localStorage.setItem('lorekeeper_masterlist_view', 'list');
            }
        }
<<<<<<< HEAD
    });
</script>

=======

        var $featureBody = $('#featureBody');
        var $featureSelect = $('#featureContent .feature-block');
        var $addFeatureButton = $('.add-feature-button');

        // handle the ones that were already there
        var $existingFeatures = $('#featureBody .feature-block');
        $existingFeatures.find('.selectize').selectize();
        addRemoveListener($existingFeatures);

        $addFeatureButton.on('click', function(e) {
            e.preventDefault();
            var $clone = $featureSelect.clone();
            $featureBody.append($clone);
            $clone.find('.selectize').selectize();
            addRemoveListener($clone);
        });

        function addRemoveListener($node)
        {
            $node.find('.feature-remove').on('click', function(e) {
                e.preventDefault();
                $(this).parent().parent().parent().remove();
            });
        }
    });
</script>
>>>>>>> Cylunny/extension/polls-and-forms
