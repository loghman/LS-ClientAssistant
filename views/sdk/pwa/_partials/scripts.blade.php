<script>

    // in page search
    const findInput = document.getElementById('find');
    const findStat = document.getElementById('findStat');
    function setFindStatValue(count,icon = 1){
        findStat.innerHTML = toPersianNum(count) + " مورد";
        if(icon)
            findStat.innerHTML += "<i class='fa-solid fa-circle-xmark'></i>";
    }
    if(findInput){
        const groupSelector = findInput.dataset.group;
        const parentSelector = findInput.dataset.parent;
        const contentSelector = findInput.dataset.content;
        const allCount = document.querySelectorAll(parentSelector).length;
        setFindStatValue(allCount,0);
        // create result div
        const resultDiv = document.createElement('div');
        resultDiv.id = 'ips-no-result';
        resultDiv.classList.add('find-result');
        const targetElement = document.querySelector(groupSelector ? groupSelector : parentSelector)
        targetElement.parentNode.insertAdjacentElement('afterbegin',resultDiv);


        findInput.addEventListener('keyup', function() {
            removeTagsKeepContents('strong.smatch');
            const searchTerm = findInput.value.toLowerCase();
            document.querySelectorAll(contentSelector).forEach(element => {
                const parent = element.closest(parentSelector);
                if (parent) {                    
                    if (searchTerm === '' || element.textContent.toLowerCase().includes(searchTerm)) {
                        parent.classList.remove('hide');
                        element.innerHTML = element.innerHTML.replace(searchTerm, "<strong class='smatch'>"+searchTerm+"</strong>");
                    } else {
                        parent.classList.add('hide');
                    }
                }
            });
            document.querySelectorAll(groupSelector).forEach(group => {
                if(group.querySelectorAll(parentSelector).length == group.querySelectorAll(".hide"+parentSelector).length){
                    group.classList.add('hide');
                } else {
                    group.classList.remove('hide');
                }

            });

            let hideCount = document.querySelectorAll(".hide"+parentSelector).length;
            let resultCount = allCount-hideCount;
            setFindStatValue(resultCount);

            if(document.querySelectorAll(parentSelector).length == document.querySelectorAll(".hide"+parentSelector).length){
                text = "با عبارت <span>" + searchTerm + "</span> چیزی پیدا نشد!";
                resultDiv.innerHTML = text;
                resultDiv.style.display = 'block';
            }else{
                resultDiv.innerHTML = '';
                resultDiv.style.display = 'none';
            }
        });
        findStat.addEventListener('click', function() {
            document.querySelectorAll(groupSelector+","+parentSelector).forEach(element => {
                element.classList.remove('hide');
            });
            setFindStatValue(allCount,0);
            removeTagsKeepContents('strong.smatch');
            findInput.value = '';
            resultDiv.innerHTML = '';
            resultDiv.style.display = 'none';
            findInput.focus();
        });

    }
    function removeTagsKeepContents(selector) {
        const tags = document.querySelectorAll(selector);
        tags.forEach(tag => {
            const fragment = document.createDocumentFragment();
            while (tag.firstChild) {
                fragment.appendChild(tag.firstChild);
            }
            tag.parentNode.replaceChild(fragment, tag);
        });
    }

    function toggleMoreText() {
        var textContainer = document.querySelector('.longtextwrap');
        var button = document.querySelector('.moretext');

        if (textContainer.classList.contains('expanded')) {
            textContainer.classList.remove('expanded');
            button.textContent = "ادامه توضیحات ...";
        } else {
            textContainer.classList.add('expanded');
            button.textContent = "بستن توضیحات";
        }
    }

    function getQueryParam(key) {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        return urlParams.get(key);
    }

    function goScrollTo(element, offset = 5,expand = 0,scroll_enabled = 1){
        // scroll
        if(scroll_enabled){
            var elementPosition = element.getBoundingClientRect().top;
            var offsetPosition = elementPosition + window.pageYOffset - offset;
            window.scrollTo({top: offsetPosition, behavior: "smooth"});
        }
        // expand
        setTimeout(function() {
            element.click();
            if(expand == 1)
                element.classList.add("expanded")
        }, 200);
    }




    function circleProgressbar(percent = 0, size = 'sm', className = '', stroke = '', color = '#777', fw = '500') {
        percent = percent || 0;
        const strokeTheme = percent <= 99 ? 'var(--primary)' : 'var(--primary)';
        const circleCircumference = 3.14 * (8 * 2);
        const dashOffset = circleCircumference * (1 - percent / 100);
        let svg = `<svg viewBox='0 0 20 20' class='progress-circle ${className} ${size}'>
            <circle cx='10' cy='10' r='8' class='bg' style='${stroke ? `stroke:${stroke};` : ''}'></circle>`;
        if (percent > 0) {
            svg += `<circle cx='10' cy='10' r='8' class='percent' stroke='${strokeTheme}' fill='none'
                    stroke-dasharray='${circleCircumference}' stroke-dashoffset='${dashOffset}'></circle>`;
        }
        svg += `<text x='50%' y='59%' style='${color ? `fill: ${color};` : ''}${fw ? `font-weight:${fw};` : ''}'>${toPersianNum(percent)}٪</text>
        </svg>`;
        return svg;
    }
    function toPersianNum(num) {
        const persianDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        return num.toString().replace(/\d/g, x => persianDigits[x]);
    }

        // add service worker
        if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('/service-worker.js')
                .then(function(registration) {
                    console.log('Service Worker registered:', registration.scope);
                }, function(error) {
                    console.log('Service Worker failed:', error);
                });
        });
    }
    function typeWriter(text, elementId, speed) {
        let i = 0;
        const element = document.getElementById(elementId);
        if(element.innerHTML.length > 0)
            return;
        element.innerHTML = "";
        function type() {
            if (i < text.length) {
            element.innerHTML += text.charAt(i++);
            setTimeout(type, speed);
            }
        }
        type();
    }

    document.querySelectorAll('[data-copy]').forEach(element => {
        element.addEventListener('click', function(event) {
            event.stopPropagation();
            navigator.clipboard.writeText(this.dataset.copy);
            if(element.classList.contains('fa-copy')){
                element.style.color="var(--primary)";
            }
        });
    });

</script>