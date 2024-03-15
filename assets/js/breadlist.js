    function extractBreadcrumbsFromHtml() {
      const items = document.querySelectorAll('#topic__path li');
      const breadcrumbs = [];

      items.forEach((item, index) => {
        const link = item.querySelector('a');
        let name, url;

        if (link) {
          name = link.querySelector('span').textContent;
          url = link.getAttribute('href');
        } else {
          name = item.querySelector('span').textContent;
          url = window.location.href;
        }

        breadcrumbs.push({
          name: name,
          url: url,
          position: index + 1
        });
      });

      return breadcrumbs;
    }

    function generateBreadcrumbJsonLd(breadcrumbs) {
      const itemListElement = breadcrumbs.map(breadcrumb => {
        return {
          '@type': 'ListItem',
          'position': breadcrumb.position,
          'item': {
            '@id': breadcrumb.url,
            'name': breadcrumb.name
          }
        };
      });

      return JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'BreadcrumbList',
        'itemListElement': itemListElement
      });
    }

    function outputBreadcrumbsJsonLd() {
      const topicPathElement = document.getElementById('topic__path');
      const breadcrumbs = extractBreadcrumbsFromHtml();
      const jsonLd = generateBreadcrumbJsonLd(breadcrumbs);

      const scriptElement = document.createElement('script');
      scriptElement.type = 'application/ld+json';
      scriptElement.textContent = jsonLd;
      topicPathElement.insertAdjacentElement('afterend', scriptElement);
    }

    // 非同期に処理を行う
    window.addEventListener('load', () => {
      setTimeout(outputBreadcrumbsJsonLd, 0);
    });