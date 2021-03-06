<?php declare(strict_types=1);

return [
    'OrderConfirmation' => [
        'en-GB' => [
            'html' => '
                <div style="font-family:arial; font-size:12px;">

                {% set currencyIsoCode = order.currency.isoCode %}
                {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},<br>
                <br>
                Thank you for your order at {{ salesChannel.name }} (Number: {{order.orderNumber}}) on {{ order.orderDateTime|date }}.<br>
                <br>
                <strong>Information on your order:</strong><br>
                <br>

                <table width="80%" border="0" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;">
                    <tr>
                        <td bgcolor="#F7F7F2" style="border-bottom:1px solid #cccccc;"><strong>Pos.</strong></td>
                        <td bgcolor="#F7F7F2" style="border-bottom:1px solid #cccccc;"><strong>Description</strong></td>
                        <td bgcolor="#F7F7F2" style="border-bottom:1px solid #cccccc;"><strong>Quantities</strong></td>
                        <td bgcolor="#F7F7F2" style="border-bottom:1px solid #cccccc;"><strong>Price</strong></td>
                        <td bgcolor="#F7F7F2" style="border-bottom:1px solid #cccccc;"><strong>Total</strong></td>
                    </tr>

                    {% for lineItem in order.lineItems %}
                    <tr>
                        <td style="border-bottom:1px solid #cccccc;">{{ loop.index }} </td>
                        <td style="border-bottom:1px solid #cccccc;">
                          {{ lineItem.label|u.wordwrap(80) }}<br>
                            {% if lineItem.payload.options is defined and lineItem.payload.options|length >= 1 %}
                                {% for option in lineItem.payload.options %}
                                    {{ option.group }}: {{ option.option }}
                                    {% if lineItem.payload.options|last != option %}
                                        {{ " | " }}
                                    {% endif %}
                                {% endfor %}
                                <br/>
                            {% endif %}
                          {% if lineItem.payload.productNumber is defined %}Prod. No.: {{ lineItem.payload.productNumber|u.wordwrap(80) }}{% endif %}
                        </td>
                        <td style="border-bottom:1px solid #cccccc;">{{ lineItem.quantity }}</td>
                        <td style="border-bottom:1px solid #cccccc;">{{ lineItem.unitPrice|currency(currencyIsoCode) }}</td>
                        <td style="border-bottom:1px solid #cccccc;">{{ lineItem.totalPrice|currency(currencyIsoCode) }}</td>
                    </tr>
                    {% endfor %}
                </table>

                {% set delivery = order.deliveries.first %}
                <p>
                    <br>
                    <br>
                    Shipping costs: {{order.deliveries.first.shippingCosts.totalPrice|currency(currencyIsoCode) }}<br>

                    Net total: {{ order.amountNet|currency(currencyIsoCode) }}<br>
                    {% for calculatedTax in order.price.calculatedTaxes %}
                        {% if order.taxStatus is same as(\'net\') %}plus{% else %}including{% endif %} {{ calculatedTax.taxRate }}% VAT. {{ calculatedTax.tax|currency(currencyIsoCode) }}<br>
                    {% endfor %}
                    <strong>Total gross: {{ order.amountTotal|currency(currencyIsoCode) }}</strong><br>

                    <br>

                    <strong>Selected payment type:</strong> {{ order.transactions.first.paymentMethod.name }}<br>
                    {{ order.transactions.first.paymentMethod.description }}<br>
                    <br>

                    <strong>Selected shipping type:</strong> {{ delivery.shippingMethod.name }}<br>
                    {{ delivery.shippingMethod.description }}<br>
                    <br>

                    {% set billingAddress = order.addresses.get(order.billingAddressId) %}
                    <strong>Billing address:</strong><br>
                    {{ billingAddress.company }}<br>
                    {{ billingAddress.firstName }} {{ billingAddress.lastName }}<br>
                    {{ billingAddress.street }} <br>
                    {{ billingAddress.zipcode }} {{ billingAddress.city }}<br>
                    {{ billingAddress.country.name }}<br>
                    <br>

                    <strong>Shipping address:</strong><br>
                    {{ delivery.shippingOrderAddress.company }}<br>
                    {{ delivery.shippingOrderAddress.firstName }} {{ delivery.shippingOrderAddress.lastName }}<br>
                    {{ delivery.shippingOrderAddress.street }} <br>
                    {{ delivery.shippingOrderAddress.zipcode}} {{ delivery.shippingOrderAddress.city }}<br>
                    {{ delivery.shippingOrderAddress.country.name }}<br>
                    <br>
                    {% if billingAddress.vatId %}
                        Your VAT-ID: {{ billingAddress.vatId }}
                        In case of a successful order and if you are based in one of the EU countries, you will receive your goods exempt from turnover tax.<br>
                    {% endif %}
                    <br/>
                    You can check the current status of your order on our website under "My account" - "My orders" anytime: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                    </br>
                    If you have any questions, do not hesitate to contact us.

                </p>
                <br>
                </div>
            ',
            'plain' => '
                {% set currencyIsoCode = order.currency.isoCode %}
                {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},

                Thank you for your order at {{ salesChannel.name }} (Number: {{order.orderNumber}}) on {{ order.orderDateTime|date }}.

                Information on your order:

                Pos.   Prod. No.			Description			Quantities			Price			Total
                {% for lineItem in order.lineItems %}
                {{ loop.index }}      {% if lineItem.payload.productNumber is defined %}{{ lineItem.payload.productNumber|u.wordwrap(80) }}{% endif %}				{{ lineItem.label|u.wordwrap(80) }}{% if lineItem.payload.options is defined and lineItem.payload.options|length >= 1 %}, {% for option in lineItem.payload.options %}{{ option.group }}: {{ option.option }}{% if lineItem.payload.options|last != option %}{{ " | " }}{% endif %}{% endfor %}{% endif %}				{{ lineItem.quantity }}			{{ lineItem.unitPrice|currency(currencyIsoCode) }}			{{ lineItem.totalPrice|currency(currencyIsoCode) }}
                {% endfor %}

                {% set delivery = order.deliveries.first %}

                Shipping costs: {{order.deliveries.first.shippingCosts.totalPrice|currency(currencyIsoCode) }}
                Net total: {{ order.amountNet|currency(currencyIsoCode) }}
                    {% for calculatedTax in order.price.calculatedTaxes %}
                           {% if order.taxStatus is same as(\'net\') %}plus{% else %}including{% endif %} {{ calculatedTax.taxRate }}% VAT. {{ calculatedTax.tax|currency(currencyIsoCode) }}
                    {% endfor %}
                Total gross: {{ order.amountTotal|currency(currencyIsoCode) }}


                Selected payment type: {{ order.transactions.first.paymentMethod.name }}
                {{ order.transactions.first.paymentMethod.description }}

                Selected shipping type: {{ delivery.shippingMethod.name }}
                {{ delivery.shippingMethod.description }}

                {% set billingAddress = order.addresses.get(order.billingAddressId) %}
                Billing address:
                {{ billingAddress.company }}
                {{ billingAddress.firstName }} {{ billingAddress.lastName }}
                {{ billingAddress.street }}
                {{ billingAddress.zipcode }} {{ billingAddress.city }}
                {{ billingAddress.country.name }}

                Shipping address:
                {{ delivery.shippingOrderAddress.company }}
                {{ delivery.shippingOrderAddress.firstName }} {{ delivery.shippingOrderAddress.lastName }}
                {{ delivery.shippingOrderAddress.street }}
                {{ delivery.shippingOrderAddress.zipcode}} {{ delivery.shippingOrderAddress.city }}
                {{ delivery.shippingOrderAddress.country.name }}

                {% if billingAddress.vatId %}
                Your VAT-ID: {{ billingAddress.vatId }}
                In case of a successful order and if you are based in one of the EU countries, you will receive your goods exempt from turnover tax.
                {% endif %}

                You can check the current status of your order on our website under "My account" - "My orders" anytime: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                If you have any questions, do not hesitate to contact us.

                However, in case you have purchased without a registration or a customer account, you do not have this option.',
        ],
        'de-DE' => [
            'html' => '
                <div style="font-family:arial; font-size:12px;">

                {% set currencyIsoCode = order.currency.isoCode %}
                Hallo {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},<br>
                <br>
                vielen Dank f??r Ihre Bestellung im {{ salesChannel.name }} (Nummer: {{order.orderNumber}}) am {{ order.orderDateTime|date }}.<br>
                <br>
                <strong>Informationen zu Ihrer Bestellung:</strong><br>
                <br>

                <table width="80%" border="0" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;">
                    <tr>
                        <td bgcolor="#F7F7F2" style="border-bottom:1px solid #cccccc;"><strong>Pos.</strong></td>
                        <td bgcolor="#F7F7F2" style="border-bottom:1px solid #cccccc;"><strong>Bezeichnung</strong></td>
                        <td bgcolor="#F7F7F2" style="border-bottom:1px solid #cccccc;"><strong>Menge</strong></td>
                        <td bgcolor="#F7F7F2" style="border-bottom:1px solid #cccccc;"><strong>Preis</strong></td>
                        <td bgcolor="#F7F7F2" style="border-bottom:1px solid #cccccc;"><strong>Summe</strong></td>
                    </tr>

                    {% for lineItem in order.lineItems %}
                    <tr>
                        <td style="border-bottom:1px solid #cccccc;">{{ loop.index }} </td>
                        <td style="border-bottom:1px solid #cccccc;">
                          {{ lineItem.label|u.wordwrap(80) }}<br>
                            {% if lineItem.payload.options is defined and lineItem.payload.options|length >= 1 %}
                                {% for option in lineItem.payload.options %}
                                    {{ option.group }}: {{ option.option }}
                                    {% if lineItem.payload.options|last != option %}
                                        {{ " | " }}
                                    {% endif %}
                                {% endfor %}
                                <br/>
                            {% endif %}
                          {% if lineItem.payload.productNumber is defined %}Artikel-Nr: {{ lineItem.payload.productNumber|u.wordwrap(80) }}{% endif %}
                        </td>
                        <td style="border-bottom:1px solid #cccccc;">{{ lineItem.quantity }}</td>
                        <td style="border-bottom:1px solid #cccccc;">{{ lineItem.unitPrice|currency(currencyIsoCode) }}</td>
                        <td style="border-bottom:1px solid #cccccc;">{{ lineItem.totalPrice|currency(currencyIsoCode) }}</td>
                    </tr>
                    {% endfor %}
                </table>

                {% set delivery = order.deliveries.first %}
                <p>
                    <br>
                    <br>
                    Versandkosten: {{order.deliveries.first.shippingCosts.totalPrice|currency(currencyIsoCode) }}<br>
                    Gesamtkosten Netto: {{ order.amountNet|currency(currencyIsoCode) }}<br>
                        {% for calculatedTax in order.price.calculatedTaxes %}
                            {% if order.taxStatus is same as(\'net\') %}zzgl.{% else %}inkl.{% endif %} {{ calculatedTax.taxRate }}% MwSt. {{ calculatedTax.tax|currency(currencyIsoCode) }}<br>
                        {% endfor %}
                    <strong>Gesamtkosten Brutto: {{ order.amountTotal|currency(currencyIsoCode) }}</strong><br>
                    <br>

                    <strong>Gew??hlte Zahlungsart:</strong> {{ order.transactions.first.paymentMethod.name }}<br>
                    {{ order.transactions.first.paymentMethod.description }}<br>
                    <br>

                    <strong>Gew??hlte Versandart:</strong> {{ delivery.shippingMethod.name }}<br>
                    {{ delivery.shippingMethod.description }}<br>
                    <br>

                    {% set billingAddress = order.addresses.get(order.billingAddressId) %}
                    <strong>Rechnungsadresse:</strong><br>
                    {{ billingAddress.company }}<br>
                    {{ billingAddress.firstName }} {{ billingAddress.lastName }}<br>
                    {{ billingAddress.street }} <br>
                    {{ billingAddress.zipcode }} {{ billingAddress.city }}<br>
                    {{ billingAddress.country.name }}<br>
                    <br>

                    <strong>Lieferadresse:</strong><br>
                    {{ delivery.shippingOrderAddress.company }}<br>
                    {{ delivery.shippingOrderAddress.firstName }} {{ delivery.shippingOrderAddress.lastName }}<br>
                    {{ delivery.shippingOrderAddress.street }} <br>
                    {{ delivery.shippingOrderAddress.zipcode}} {{ delivery.shippingOrderAddress.city }}<br>
                    {{ delivery.shippingOrderAddress.country.name }}<br>
                    <br>
                    {% if billingAddress.vatId %}
                        Ihre Umsatzsteuer-ID: {{ billingAddress.vatId }}
                        Bei erfolgreicher Pr??fung und sofern Sie aus dem EU-Ausland
                        bestellen, erhalten Sie Ihre Ware umsatzsteuerbefreit. <br>
                    {% endif %}
                    <br/>
                    Den aktuellen Status Ihrer Bestellung k??nnen Sie auch jederzeit auf unserer Webseite im  Bereich "Mein Konto" - "Meine Bestellungen" abrufen: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                    </br>
                    F??r R??ckfragen stehen wir Ihnen jederzeit gerne zur Verf??gung.

                </p>
                <br>
                </div>
            ',
            'plain' => '
                {% set currencyIsoCode = order.currency.isoCode %}
                Hallo {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},

                vielen Dank f??r Ihre Bestellung im {{ salesChannel.name }} (Nummer: {{order.orderNumber}}) am {{ order.orderDateTime|date }}.

                Informationen zu Ihrer Bestellung:

                Pos.   Artikel-Nr.			Beschreibung			Menge			Preis			Summe
                {% for lineItem in order.lineItems %}
                {{ loop.index }}      {% if lineItem.payload.productNumber is defined %}{{ lineItem.payload.productNumber|u.wordwrap(80) }}{% endif %}				{{ lineItem.label|u.wordwrap(80) }}{% if lineItem.payload.options is defined and lineItem.payload.options|length >= 1 %}, {% for option in lineItem.payload.options %}{{ option.group }}: {{ option.option }}{% if lineItem.payload.options|last != option %}{{ " | " }}{% endif %}{% endfor %}{% endif %}				{{ lineItem.quantity }}			{{ lineItem.unitPrice|currency(currencyIsoCode) }}			{{ lineItem.totalPrice|currency(currencyIsoCode) }}
                {% endfor %}

                {% set delivery = order.deliveries.first %}

                Versandkosten: {{order.deliveries.first.shippingCosts.totalPrice|currency(currencyIsoCode) }}
                Gesamtkosten Netto: {{ order.amountNet|currency(currencyIsoCode) }}
                    {% for calculatedTax in order.price.calculatedTaxes %}
                        {% if order.taxStatus is same as(\'net\') %}zzgl.{% else %}inkl.{% endif %} {{ calculatedTax.taxRate }}% MwSt. {{ calculatedTax.tax|currency(currencyIsoCode) }}
                    {% endfor %}
                Gesamtkosten Brutto: {{ order.amountTotal|currency(currencyIsoCode) }}


                Gew??hlte Zahlungsart: {{ order.transactions.first.paymentMethod.name }}
                {{ order.transactions.first.paymentMethod.description }}

                Gew??hlte Versandart: {{ delivery.shippingMethod.name }}
                {{ delivery.shippingMethod.description }}

                {% set billingAddress = order.addresses.get(order.billingAddressId) %}
                Rechnungsadresse:
                {{ billingAddress.company }}
                {{ billingAddress.firstName }} {{ billingAddress.lastName }}
                {{ billingAddress.street }}
                {{ billingAddress.zipcode }} {{ billingAddress.city }}
                {{ billingAddress.country.name }}

                Lieferadresse:
                {{ delivery.shippingOrderAddress.company }}
                {{ delivery.shippingOrderAddress.firstName }} {{ delivery.shippingOrderAddress.lastName }}
                {{ delivery.shippingOrderAddress.street }}
                {{ delivery.shippingOrderAddress.zipcode}} {{ delivery.shippingOrderAddress.city }}
                {{ delivery.shippingOrderAddress.country.name }}

                {% if billingAddress.vatId %}
                Ihre Umsatzsteuer-ID: {{ billingAddress.vatId }}
                Bei erfolgreicher Pr??fung und sofern Sie aus dem EU-Ausland
                bestellen, erhalten Sie Ihre Ware umsatzsteuerbefreit.
                {% endif %}

                Den aktuellen Status Ihrer Bestellung k??nnen Sie auch jederzeit auf unserer Webseite im  Bereich "Mein Konto" - "Meine Bestellungen" abrufen: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                F??r R??ckfragen stehen wir Ihnen jederzeit gerne zur Verf??gung.',
        ],
    ],
    'OrderCancelled' => [
        'en-GB' => [
            'html' => '
                <div style="font-family:arial; font-size:12px;">
                 <br/>
                    <p>
                        {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},<br/>
                        <br/>
                        the status of your order at {{ salesChannel.name }} (Number: {{order.orderNumber}}) on {{ order.orderDateTime|date }} has changed.<br/>
                        <strong>The new status is as follows: {{order.stateMachineState.name}}.</strong><br/>
                        <br/>
                        You can check the current status of your order on our website under "My account" - "My orders" anytime: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                        </br>
                        However, in case you have purchased without a registration or a customer account, you do not have this option.</p>
                </div>
            ',
            'plain' => '

                {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},

                the status of your order at {{ salesChannel.name }} (Number: {{order.orderNumber}}) on {{ order.orderDateTime|date }}  has changed.
                The new status is as follows: {{order.stateMachineState.name}}.

                You can check the current status of your order on our website under "My account" - "My orders" anytime: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                However, in case you have purchased without a registration or a customer account, you do not have this option.',
        ],
        'de-DE' => [
            'html' => '
                <div style="font-family:arial; font-size:12px;">
                    <br/>
                    <p>
                        {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},<br/>
                        <br/>
                        der Lieferstatus f??r Ihre Bestellung bei {{ salesChannel.name }} (Number: {{order.orderNumber}}) vom {{ order.orderDateTime|date }} hat sich ge??ndert.<br/>
                        <strong>Die Bestellung hat jetzt den Bestellstatus: {{order.stateMachineState.name}}.</strong><br/>
                        <br/>
                        Den aktuellen Status Ihrer Bestellung k??nnen Sie auch jederzeit auf unserer Webseite im  Bereich "Mein Konto" - "Meine Bestellungen" abrufen: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                        </br>
                        Sollten Sie allerdings den Kauf ohne Registrierung, also ohne Anlage eines Kundenkontos, gew??hlt haben, steht Ihnen diese M??glichkeit nicht zur Verf??gung.
                    </p>
                </div>
            ',
            'plain' => '
                {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},

                der Bestellstatus f??r Ihre Bestellung bei {{ salesChannel.name }} (Number: {{order.orderNumber}}) vom {{ order.orderDateTime|date }} hat sich ge??ndert!
                Die Bestellung hat jetzt den Bestellstatus: {{order.stateMachineState.name}}.

                Den aktuellen Status Ihrer Bestellung k??nnen Sie auch jederzeit auf unserer Webseite im  Bereich "Mein Konto" - "Meine Bestellungen" abrufen: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                Sollten Sie allerdings den Kauf ohne Registrierung, also ohne Anlage eines Kundenkontos, gew??hlt haben, steht Ihnen diese M??glichkeit nicht zur Verf??gung.',
        ],
    ],
    'OrderOpen' => [
        'en-GB' => [
            'html' => '
                <div style="font-family:arial; font-size:12px;">
                    <br/>
                        <p>
                            {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},<br/>
                            <br/>
                            the status of your order at {{ salesChannel.name }} (Number: {{order.orderNumber}}) on {{ order.orderDateTime|date }} has changed.<br/>
                            <strong>The new status is as follows: {{order.stateMachineState.name}}.</strong><br/>
                            <br/>
                            You can check the current status of your order on our website under "My account" - "My orders" anytime: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                            </br>
                            However, in case you have purchased without a registration or a customer account, you do not have this option.
                        </p>
                </div>
            ',
            'plain' => '
                {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},

                the status of your order at {{ salesChannel.name }} (Number: {{order.orderNumber}}) on {{ order.orderDateTime|date }}  has changed.
                The new status is as follows: {{order.stateMachineState.name}}.

                You can check the current status of your order on our website under "My account" - "My orders" anytime: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                However, in case you have purchased without a registration or a customer account, you do not have this option.',
        ],
        'de-DE' => [
            'html' => '
                <div style="font-family:arial; font-size:12px;">
                    <br/>
                    <p>
                        {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},<br/>
                        <br/>
                        der Bestellstatus f??r Ihre Bestellung bei {{ salesChannel.name }} (Number: {{order.orderNumber}}) vom {{ order.orderDateTime|date }} hat sich ge??ndert.<br/>
                        <strong>Die Bestellung hat jetzt den Bestellstatus: {{order.stateMachineState.name}}.</strong><br/>
                        <br/>
                        Den aktuellen Status Ihrer Bestellung k??nnen Sie auch jederzeit auf unserer Webseite im  Bereich "Mein Konto" - "Meine Bestellungen" abrufen: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                        </br>
                        Sollten Sie allerdings den Kauf ohne Registrierung, also ohne Anlage eines Kundenkontos, gew??hlt haben, steht Ihnen diese M??glichkeit nicht zur Verf??gung.
                    </p>
                </div>
            ',
            'plain' => '
                {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},

                der Bestellstatus f??r Ihre Bestellung bei {{ salesChannel.name }} (Number: {{order.orderNumber}}) vom {{ order.orderDateTime|date }} hat sich ge??ndert!
                Die Bestellung hat jetzt den Bestellstatus: {{order.stateMachineState.name}}.

                Den aktuellen Status Ihrer Bestellung k??nnen Sie auch jederzeit auf unserer Webseite im  Bereich "Mein Konto" - "Meine Bestellungen" abrufen: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                Sollten Sie allerdings den Kauf ohne Registrierung, also ohne Anlage eines Kundenkontos, gew??hlt haben, steht Ihnen diese M??glichkeit nicht zur Verf??gung.',
        ],
    ],
    'OrderInProgress' => [
        'en-GB' => [
            'html' => '
                <div style="font-family:arial; font-size:12px;">
                    <br/>
                            {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},<br/>
                            <br/>
                            the status of your order at {{ salesChannel.name }} (Number: {{order.orderNumber}}) on {{ order.orderDateTime|date }} has changed.<br/>
                            <strong>The new status is as follows: {{order.stateMachineState.name}}.</strong><br/>
                            <br/>
                            You can check the current status of your order on our website under "My account" - "My orders" anytime: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                            </br>
                            However, in case you have purchased without a registration or a customer account, you do not have this option.
                        </p>
                </div>
            ',
            'plain' => '
                {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},

                the status of your order at {{ salesChannel.name }} (Number: {{order.orderNumber}}) on {{ order.orderDateTime|date }}  has changed.
                The new status is as follows: {{order.stateMachineState.name}}.

                You can check the current status of your order on our website under "My account" - "My orders" anytime: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                However, in case you have purchased without a registration or a customer account, you do not have this option.',
        ],
        'de-DE' => [
            'html' => '
                <div style="font-family:arial; font-size:12px;">
                    <br/>
                    <p>
                        {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},<br/>
                        <br/>
                        der Bestellstatus f??r Ihre Bestellung bei {{ salesChannel.name }} (Number: {{order.orderNumber}}) vom {{ order.orderDateTime|date }} hat sich ge??ndert.<br/>
                        <strong>Die Bestellung hat jetzt den Bestellstatus: {{order.stateMachineState.name}}.</strong><br/>
                        <br/>
                        Den aktuellen Status Ihrer Bestellung k??nnen Sie auch jederzeit auf unserer Webseite im  Bereich "Mein Konto" - "Meine Bestellungen" abrufen: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                        </br>
                        Sollten Sie allerdings den Kauf ohne Registrierung, also ohne Anlage eines Kundenkontos, gew??hlt haben, steht Ihnen diese M??glichkeit nicht zur Verf??gung.
                    </p>
                </div>
            ',
            'plain' => '
                {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},

                der Bestellstatus f??r Ihre Bestellung bei {{ salesChannel.name }} (Number: {{order.orderNumber}}) vom {{ order.orderDateTime|date }} hat sich ge??ndert!
                Die Bestellung hat jetzt den Bestellstatus: {{order.stateMachineState.name}}.

                Den aktuellen Status Ihrer Bestellung k??nnen Sie auch jederzeit auf unserer Webseite im  Bereich "Mein Konto" - "Meine Bestellungen" abrufen: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                Sollten Sie allerdings den Kauf ohne Registrierung, also ohne Anlage eines Kundenkontos, gew??hlt haben, steht Ihnen diese M??glichkeit nicht zur Verf??gung.',
        ],
    ],
    'OrderCompleted' => [
        'en-GB' => [
            'html' => '
                <div style="font-family:arial; font-size:12px;">
                    <br/>
                        <p>
                            {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},<br/>
                            <br/>
                            the status of your order at {{ salesChannel.name }} (Number: {{order.orderNumber}}) on {{ order.orderDateTime|date }} has changed.<br/>
                            <strong>The new status is as follows: {{order.stateMachineState.name}}.</strong><br/>
                            <br/>
                            You can check the current status of your order on our website under "My account" - "My orders" anytime: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                            </br>
                            However, in case you have purchased without a registration or a customer account, you do not have this option.
                        </p>
                </div>
            ',
            'plain' => '
                {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},

                the status of your order at {{ salesChannel.name }} (Number: {{order.orderNumber}}) on {{ order.orderDateTime|date }}  has changed.
                The new status is as follows: {{order.stateMachineState.name}}.

                You can check the current status of your order on our website under "My account" - "My orders" anytime: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                However, in case you have purchased without a registration or a customer account, you do not have this option.',
        ],
        'de-DE' => [
            'html' => '
                <div style="font-family:arial; font-size:12px;">
                    <br/>
                    <p>
                        {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},<br/>
                        <br/>
                        der Bestellstatus f??r Ihre Bestellung bei {{ salesChannel.name }} (Number: {{order.orderNumber}}) vom {{ order.orderDateTime|date }} hat sich ge??ndert.<br/>
                        <strong>Die Bestellung hat jetzt den Bestellstatus: {{order.stateMachineState.name}}.</strong><br/>
                        <br/>
                        Den aktuellen Status Ihrer Bestellung k??nnen Sie auch jederzeit auf unserer Webseite im  Bereich "Mein Konto" - "Meine Bestellungen" abrufen: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                        </br>
                        Sollten Sie allerdings den Kauf ohne Registrierung, also ohne Anlage eines Kundenkontos, gew??hlt haben, steht Ihnen diese M??glichkeit nicht zur Verf??gung.
                    </p>
                </div>
            ',
            'plain' => '
                {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},

                der Bestellstatus f??r Ihre Bestellung bei {{ salesChannel.name }} (Number: {{order.orderNumber}}) vom {{ order.orderDateTime|date }} hat sich ge??ndert!
                Die Bestellung hat jetzt den Bestellstatus: {{order.stateMachineState.name}}.

                Den aktuellen Status Ihrer Bestellung k??nnen Sie auch jederzeit auf unserer Webseite im  Bereich "Mein Konto" - "Meine Bestellungen" abrufen: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                Sollten Sie allerdings den Kauf ohne Registrierung, also ohne Anlage eines Kundenkontos, gew??hlt haben, steht Ihnen diese M??glichkeit nicht zur Verf??gung.',
        ],
    ],
    'DeliveryCancellation' => [
        'en-GB' => [
            'html' => '<div style="font-family:arial; font-size:12px;">
                    <br/>
                    <p>
                        {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},<br/>
                        <br/>
                        the status of your delivery at {{ salesChannel.name }} (Number: {{order.orderNumber}}) on {{ order.orderDateTime|date }} has changed.<br/>
                        <strong>The new status is as follows: {{order.deliveries.first.stateMachineState.name}}.</strong><br/>
                        <br/>
                        You can check the current status of your order on our website under "My account" - "My orders" anytime: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                        </br>
                        However, in case you have purchased without a registration or a customer account, you do not have this option.
                    </p>
                </div>',
            'plain' => '
                {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},

                the status of your delivery at {{ salesChannel.name }} (Number: {{order.orderNumber}}) on {{ order.orderDateTime|date }}  has changed.
                The new status is as follows: {{order.deliveries.first.stateMachineState.name}}.

                You can check the current status of your order on our website under "My account" - "My orders" anytime: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                However, in case you have purchased without a registration or a customer account, you do not have this option.',
        ],
        'de-DE' => [
            'html' => '
                <div style="font-family:arial; font-size:12px;">
                   <br/>
                   <p>
                       {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},<br/>
                       <br/>
                       der Lieferstatus f??r Ihre Bestellung bei {{ salesChannel.name }} (Number: {{order.orderNumber}}) vom {{ order.orderDateTime|date }} hat sich ge??ndert.<br/>
                       <strong>Die Bestellung hat jetzt den Lieferstatus: {{order.deliveries.first.stateMachineState.name}}.</strong><br/>
                       <br/>
                       Den aktuellen Status Ihrer Bestellung k??nnen Sie auch jederzeit auf unserer Webseite im  Bereich "Mein Konto" - "Meine Bestellungen" abrufen: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                       </br>
                       Sollten Sie allerdings den Kauf ohne Registrierung, also ohne Anlage eines Kundenkontos, gew??hlt haben, steht Ihnen diese M??glichkeit nicht zur Verf??gung.
                   </p>
                </div>',
            'plain' => '
                {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},

                der Lieferstatus f??r Ihre Bestellung bei {{ salesChannel.name }} (Number: {{order.orderNumber}}) vom {{ order.orderDateTime|date }} hat sich ge??ndert!
                Die Bestellung hat jetzt den Lieferstatus: {{order.deliveries.first.stateMachineState.name}}.

                Den aktuellen Status Ihrer Bestellung k??nnen Sie auch jederzeit auf unserer Webseite im  Bereich "Mein Konto" - "Meine Bestellungen" abrufen: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                Sollten Sie allerdings den Kauf ohne Registrierung, also ohne Anlage eines Kundenkontos, gew??hlt haben, steht Ihnen diese M??glichkeit nicht zur Verf??gung.',
        ],
    ],
    'DeliveryShippedPartially' => [
        'en-GB' => [
            'html' => '
                <div style="font-family:arial; font-size:12px;">
                   <br/>
                   <p>
                       {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},<br/>
                       <br/>
                       the status of your delivery at {{ salesChannel.name }} (Number: {{order.orderNumber}}) on {{ order.orderDateTime|date }} has changed.<br/>
                       <strong>The new status is as follows: {{order.deliveries.first.stateMachineState.name}}.</strong><br/>
                       <br/>
                       You can check the current status of your order on our website under "My account" - "My orders" anytime: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                        </br>
                        However, in case you have purchased without a registration or a customer account, you do not have this option.
                   </p>
                </div>
            ',
            'plain' => '
                {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},

                the status of your delivery at {{ salesChannel.name }} (Number: {{order.orderNumber}}) on {{ order.orderDateTime|date }}  has changed.
                The new status is as follows: {{order.deliveries.first.stateMachineState.name}}.

                You can check the current status of your order on our website under "My account" - "My orders" anytime: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                However, in case you have purchased without a registration or a customer account, you do not have this option.',
        ],
        'de-DE' => [
            'html' => '
                <div style="font-family:arial; font-size:12px;">
                    <br/>
                    <p>
                        {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},<br/>
                        <br/>
                        der Lieferstatus f??r Ihre Bestellung bei {{ salesChannel.name }} (Number: {{order.orderNumber}}) vom {{ order.orderDateTime|date }} hat sich ge??ndert.<br/>
                        <strong>Die Bestellung hat jetzt den Lieferstatus: {{order.deliveries.first.stateMachineState.name}}.</strong><br/>
                        <br/>
                        Den aktuellen Status Ihrer Bestellung k??nnen Sie auch jederzeit auf unserer Webseite im  Bereich "Mein Konto" - "Meine Bestellungen" abrufen: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                        </br>
                        Sollten Sie allerdings den Kauf ohne Registrierung, also ohne Anlage eines Kundenkontos, gew??hlt haben, steht Ihnen diese M??glichkeit nicht zur Verf??gung.
                    </p>
                </div>',
            'plain' => '
                    {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},

                der Lieferstatus f??r Ihre Bestellung bei {{ salesChannel.name }} (Number: {{order.orderNumber}}) vom {{ order.orderDateTime|date }} hat sich ge??ndert!
                Die Bestellung hat jetzt den Lieferstatus: {{order.deliveries.first.stateMachineState.name}}.

                Den aktuellen Status Ihrer Bestellung k??nnen Sie auch jederzeit auf unserer Webseite im  Bereich "Mein Konto" - "Meine Bestellungen" abrufen: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                Sollten Sie allerdings den Kauf ohne Registrierung, also ohne Anlage eines Kundenkontos, gew??hlt haben, steht Ihnen diese M??glichkeit nicht zur Verf??gung.',
        ],
    ],
    'DeliveryShipped' => [
        'en-GB' => [
            'html' => '
                <div style="font-family:arial; font-size:12px;">
                    <br/>
                    <p>
                        {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},<br/>
                        <br/>
                        the status of your delivery at {{ salesChannel.name }} (Number: {{order.orderNumber}}) on {{ order.orderDateTime|date }} has changed.<br/>
                        <strong>The new status is as follows: {{order.deliveries.first.stateMachineState.name}}.</strong><br/>
                        <br/>
                        You can check the current status of your order on our website under "My account" - "My orders" anytime: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                        </br>
                        However, in case you have purchased without a registration or a customer account, you do not have this option.
                    </p>
                </div>
            ',
            'plain' => '
                {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},

                the status of your delivery at {{ salesChannel.name }} (Number: {{order.orderNumber}}) on {{ order.orderDateTime|date }}  has changed.
                The new status is as follows: {{order.deliveries.first.stateMachineState.name}}.

                You can check the current status of your order on our website under "My account" - "My orders" anytime: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                However, in case you have purchased without a registration or a customer account, you do not have this option.',
        ],
        'de-DE' => [
            'html' => '
                <div style="font-family:arial; font-size:12px;">
                    <br/>
                    <p>
                        {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},<br/>
                        <br/>
                        der Lieferstatus f??r Ihre Bestellung bei {{ salesChannel.name }} (Number: {{order.orderNumber}}) vom {{ order.orderDateTime|date }} hat sich ge??ndert.<br/>
                        <strong>Die Bestellung hat jetzt den Lieferstatus: {{order.deliveries.first.stateMachineState.name}}.</strong><br/>
                        <br/>
                        Den aktuellen Status Ihrer Bestellung k??nnen Sie auch jederzeit auf unserer Webseite im  Bereich "Mein Konto" - "Meine Bestellungen" abrufen: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                        </br>
                        Sollten Sie allerdings den Kauf ohne Registrierung, also ohne Anlage eines Kundenkontos, gew??hlt haben, steht Ihnen diese M??glichkeit nicht zur Verf??gung.
                    </p>
                </div>
            ',
            'plain' => '
                {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},

                der Lieferstatus f??r Ihre Bestellung bei {{ salesChannel.name }} (Number: {{order.orderNumber}}) vom {{ order.orderDateTime|date }} hat sich ge??ndert!
                Die Bestellung hat jetzt den Lieferstatus: {{order.deliveries.first.stateMachineState.name}}.

                Den aktuellen Status Ihrer Bestellung k??nnen Sie auch jederzeit auf unserer Webseite im  Bereich "Mein Konto" - "Meine Bestellungen" abrufen: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                Sollten Sie allerdings den Kauf ohne Registrierung, also ohne Anlage eines Kundenkontos, gew??hlt haben, steht Ihnen diese M??glichkeit nicht zur Verf??gung.',
        ],
    ],
    'DeliveryReturnedPartially' => [
        'en-GB' => [
            'html' => '
                <div style="font-family:arial; font-size:12px;">
                    <br/>
                    <p>
                        {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},<br/>
                        <br/>
                        the status of your delivery at {{ salesChannel.name }} (Number: {{order.orderNumber}}) on {{ order.orderDateTime|date }} has changed.<br/>
                        <strong>The new status is as follows: {{order.deliveries.first.stateMachineState.name}}.</strong><br/>
                        <br/>
                        You can check the current status of your order on our website under "My account" - "My orders" anytime: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                        </br>
                        However, in case you have purchased without a registration or a customer account, you do not have this option.
                    </p>
                </div>
            ',
            'plain' => '
                {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},

                the status of your delivery at {{ salesChannel.name }} (Number: {{order.orderNumber}}) on {{ order.orderDateTime|date }}  has changed.
                The new status is as follows: {{order.deliveries.first.stateMachineState.name}}.

                You can check the current status of your order on our website under "My account" - "My orders" anytime: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                However, in case you have purchased without a registration or a customer account, you do not have this option.',
        ],
        'de-DE' => [
            'html' => '
                <div style="font-family:arial; font-size:12px;">
                    <br/>
                    <p>
                        {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},<br/>
                        <br/>
                        der Lieferstatus f??r Ihre Bestellung bei {{ salesChannel.name }} (Number: {{order.orderNumber}}) vom {{ order.orderDateTime|date }} hat sich ge??ndert.<br/>
                        <strong>Die Bestellung hat jetzt den Lieferstatus: {{order.deliveries.first.stateMachineState.name}}.</strong><br/>
                        <br/>
                        Den aktuellen Status Ihrer Bestellung k??nnen Sie auch jederzeit auf unserer Webseite im  Bereich "Mein Konto" - "Meine Bestellungen" abrufen: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                        </br>
                        Sollten Sie allerdings den Kauf ohne Registrierung, also ohne Anlage eines Kundenkontos, gew??hlt haben, steht Ihnen diese M??glichkeit nicht zur Verf??gung.
                    </p>
                </div>
            ',
            'plain' => '
                {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},

                der Lieferstatus f??r Ihre Bestellung bei {{ salesChannel.name }} (Number: {{order.orderNumber}}) vom {{ order.orderDateTime|date }} hat sich ge??ndert!
                Die Bestellung hat jetzt den Lieferstatus: {{order.deliveries.first.stateMachineState.name}}.

                Den aktuellen Status Ihrer Bestellung k??nnen Sie auch jederzeit auf unserer Webseite im  Bereich "Mein Konto" - "Meine Bestellungen" abrufen: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                Sollten Sie allerdings den Kauf ohne Registrierung, also ohne Anlage eines Kundenkontos, gew??hlt haben, steht Ihnen diese M??glichkeit nicht zur Verf??gung.',
        ],
    ],
    'DeliveryReturned' => [
        'en-GB' => [
            'html' => '
                <div style="font-family:arial; font-size:12px;">
                    <br/>
                      <p>
                          {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},<br/>
                          <br/>
                          the status of your delivery at {{ salesChannel.name }} (Number: {{order.orderNumber}}) on {{ order.orderDateTime|date }} has changed.<br/>
                          <strong>The new status is as follows: {{order.deliveries.first.stateMachineState.name}}.</strong><br/>
                          <br/>
                          You can check the current status of your order on our website under "My account" - "My orders" anytime: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                          </br>
                          However, in case you have purchased without a registration or a customer account, you do not have this option.
                    </p>
                </div>
            ',
            'plain' => '
                {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},

                the status of your delivery at {{ salesChannel.name }} (Number: {{order.orderNumber}}) on {{ order.orderDateTime|date }}  has changed.
                The new status is as follows: {{order.deliveries.first.stateMachineState.name}}.

                You can check the current status of your order on our website under "My account" - "My orders" anytime: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                However, in case you have purchased without a registration or a customer account, you do not have this option.',
        ],
        'de-DE' => [
            'html' => '
                <div style="font-family:arial; font-size:12px;">
                    <br/>
                    <p>
                        {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},<br/>
                        <br/>
                        der Lieferstatus f??r Ihre Bestellung bei {{ salesChannel.name }} (Number: {{order.orderNumber}}) vom {{ order.orderDateTime|date }} hat sich ge??ndert.<br/>
                        <strong>Die Bestellung hat jetzt den Lieferstatus: {{order.deliveries.first.stateMachineState.name}}.</strong><br/>
                        <br/>
                        Den aktuellen Status Ihrer Bestellung k??nnen Sie auch jederzeit auf unserer Webseite im  Bereich "Mein Konto" - "Meine Bestellungen" abrufen: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                        </br>
                        Sollten Sie allerdings den Kauf ohne Registrierung, also ohne Anlage eines Kundenkontos, gew??hlt haben, steht Ihnen diese M??glichkeit nicht zur Verf??gung.
                    </p>
                </div>',
            'plain' => '
                {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},

                der Lieferstatus f??r Ihre Bestellung bei {{ salesChannel.name }} (Number: {{order.orderNumber}}) vom {{ order.orderDateTime|date }} hat sich ge??ndert!
                Die Bestellung hat jetzt den Lieferstatus: {{order.deliveries.first.stateMachineState.name}}.

                Den aktuellen Status Ihrer Bestellung k??nnen Sie auch jederzeit auf unserer Webseite im  Bereich "Mein Konto" - "Meine Bestellungen" abrufen: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                Sollten Sie allerdings den Kauf ohne Registrierung, also ohne Anlage eines Kundenkontos, gew??hlt haben, steht Ihnen diese M??glichkeit nicht zur Verf??gung.',
        ],
    ],
    'PaymentRefundedPartially' => [
        'en-GB' => [
            'html' => '
                <div style="font-family:arial; font-size:12px;">
                    <br/>
                        <p>
                            {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},<br/>
                            <br/>
                            the status of your order at {{ salesChannel.name }} (Number: {{order.orderNumber}}) on {{ order.orderDateTime|date }} has changed.<br/>
                            <strong>The new status is as follows: {{order.transactions.first.stateMachineState.name}}.</strong><br/>
                            <br/>
                            <br/>
                            You can check the current status of your order on our website under "My account" - "My orders" anytime: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                            </br>
                            However, in case you have purchased without a registration or a customer account, you do not have this option.
                        </p>
                </div>
            ',
            'plain' => '
                {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},

                the status of your order at {{ salesChannel.name }} (Number: {{order.orderNumber}}) on {{ order.orderDateTime|date }}  has changed.
                The new status is as follows: {{order.transactions.first.stateMachineState.name}}.

                You can check the current status of your order on our website under "My account" - "My orders" anytime: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                However, in case you have purchased without a registration or a customer account, you do not have this option.',
        ],
        'de-DE' => [
            'html' => '
                <div style="font-family:arial; font-size:12px;">
                    <br/>
                    <p>
                        {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},<br/>
                        <br/>
                        der Zahlungsstatus f??r Ihre Bestellung bei {{ salesChannel.name }} (Number: {{order.orderNumber}}) vom {{ order.orderDateTime|date }} hat sich ge??ndert.<br/>
                        <strong>Die Bestellung hat jetzt den Zahlungsstatus: {{order.transactions.first.stateMachineState.name}}.</strong><br/>
                        <br/>
                        Den aktuellen Status Ihrer Bestellung k??nnen Sie auch jederzeit auf unserer Webseite im  Bereich "Mein Konto" - "Meine Bestellungen" abrufen: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                        </br>
                        Sollten Sie allerdings den Kauf ohne Registrierung, also ohne Anlage eines Kundenkontos, gew??hlt haben, steht Ihnen diese M??glichkeit nicht zur Verf??gung.
                    </p>
                </div>
            ',
            'plain' => '
                {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},

                der Zahlungsstatus f??r Ihre Bestellung bei {{ salesChannel.name }} (Number: {{order.orderNumber}}) vom {{ order.orderDateTime|date }} hat sich ge??ndert!
                Die Bestellung hat jetzt den Zahlungsstatus: {{order.transactions.first.stateMachineState.name}}.

                Den aktuellen Status Ihrer Bestellung k??nnen Sie auch jederzeit auf unserer Webseite im  Bereich "Mein Konto" - "Meine Bestellungen" abrufen: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                Sollten Sie allerdings den Kauf ohne Registrierung, also ohne Anlage eines Kundenkontos, gew??hlt haben, steht Ihnen diese M??glichkeit nicht zur Verf??gung.',
        ],
    ],
    'PaymentRefunded' => [
        'en-GB' => [
            'html' => '
                <div style="font-family:arial; font-size:12px;">
                    <br/>
                        <p>
                            {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},<br/>
                            <br/>
                            the status of your order at {{ salesChannel.name }} (Number: {{order.orderNumber}}) on {{ order.orderDateTime|date }} has changed.<br/>
                            <strong>The new status is as follows: {{order.transactions.first.stateMachineState.name}}.</strong><br/>
                            <br/>
                            You can check the current status of your order on our website under "My account" - "My orders" anytime: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                            </br>
                            However, in case you have purchased without a registration or a customer account, you do not have this option.
                        </p>
                </div>
            ',
            'plain' => '
                {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},

                the status of your order at {{ salesChannel.name }} (Number: {{order.orderNumber}}) on {{ order.orderDateTime|date }}  has changed.
                The new status is as follows: {{order.transactions.first.stateMachineState.name}}.

                You can check the current status of your order on our website under "My account" - "My orders" anytime: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                However, in case you have purchased without a registration or a customer account, you do not have this option.',
        ],
        'de-DE' => [
            'html' => '
                <div style="font-family:arial; font-size:12px;">
                    <br/>
                    <p>
                        {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},<br/>
                        <br/>
                        der Zahlungsstatus f??r Ihre Bestellung bei {{ salesChannel.name }} (Number: {{order.orderNumber}}) vom {{ order.orderDateTime|date }} hat sich ge??ndert.<br/>
                        <strong>Die Bestellung hat jetzt den Zahlungsstatus: {{order.transactions.first.stateMachineState.name}}.</strong><br/>
                        <br/>
                        Den aktuellen Status Ihrer Bestellung k??nnen Sie auch jederzeit auf unserer Webseite im  Bereich "Mein Konto" - "Meine Bestellungen" abrufen: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                        </br>
                        Sollten Sie allerdings den Kauf ohne Registrierung, also ohne Anlage eines Kundenkontos, gew??hlt haben, steht Ihnen diese M??glichkeit nicht zur Verf??gung.
                    </p>
                </div>
            ',
            'plain' => '
                {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},

                der Zahlungsstatus f??r Ihre Bestellung bei {{ salesChannel.name }} (Number: {{order.orderNumber}}) vom {{ order.orderDateTime|date }} hat sich ge??ndert!
                Die Bestellung hat jetzt den Zahlungsstatus: {{order.transactions.first.stateMachineState.name}}.

                Den aktuellen Status Ihrer Bestellung k??nnen Sie auch jederzeit auf unserer Webseite im  Bereich "Mein Konto" - "Meine Bestellungen" abrufen: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                Sollten Sie allerdings den Kauf ohne Registrierung, also ohne Anlage eines Kundenkontos, gew??hlt haben, steht Ihnen diese M??glichkeit nicht zur Verf??gung.',
        ],
    ],
    'PaymentReminded' => [
        'en-GB' => [
            'html' => '
                <div style="font-family:arial; font-size:12px;">
                    <br/>
                        <p>
                            {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},<br/>
                            <br/>
                            the status of your order at {{ salesChannel.name }} (Number: {{order.orderNumber}}) on {{ order.orderDateTime|date }} has changed.<br/>
                            <strong>The new status is as follows: {{order.transactions.first.stateMachineState.name}}.</strong><br/>
                            <br/>
                            You can check the current status of your order on our website under "My account" - "My orders" anytime: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                            </br>
                            However, in case you have purchased without a registration or a customer account, you do not have this option.
                        </p>
                </div>
            ',
            'plain' => '
                {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},

                the status of your order at {{ salesChannel.name }} (Number: {{order.orderNumber}}) on {{ order.orderDateTime|date }}  has changed.
                The new status is as follows: {{order.transactions.first.stateMachineState.name}}.

                You can check the current status of your order on our website under "My account" - "My orders" anytime: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                However, in case you have purchased without a registration or a customer account, you do not have this option.',
        ],
        'de-DE' => [
            'html' => '
                <div style="font-family:arial; font-size:12px;">
                    <br/>
                    <p>
                        {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},<br/>
                        <br/>
                        der Zahlungsstatus f??r Ihre Bestellung bei {{ salesChannel.name }} (Number: {{order.orderNumber}}) vom {{ order.orderDateTime|date }} hat sich ge??ndert.<br/>
                        <strong>Die Bestellung hat jetzt den Zahlungsstatus: {{order.transactions.first.stateMachineState.name}}.</strong><br/>
                        <br/>
                        Den aktuellen Status Ihrer Bestellung k??nnen Sie auch jederzeit auf unserer Webseite im  Bereich "Mein Konto" - "Meine Bestellungen" abrufen: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                        </br>
                        Sollten Sie allerdings den Kauf ohne Registrierung, also ohne Anlage eines Kundenkontos, gew??hlt haben, steht Ihnen diese M??glichkeit nicht zur Verf??gung.
                    </p>
                </div>
            ',
            'plain' => '
                {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},

                der Zahlungsstatus f??r Ihre Bestellung bei {{ salesChannel.name }} (Number: {{order.orderNumber}}) vom {{ order.orderDateTime|date }} hat sich ge??ndert!
                Die Bestellung hat jetzt den Zahlungsstatus: {{order.transactions.first.stateMachineState.name}}.

                Den aktuellen Status Ihrer Bestellung k??nnen Sie auch jederzeit auf unserer Webseite im  Bereich "Mein Konto" - "Meine Bestellungen" abrufen: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                Sollten Sie allerdings den Kauf ohne Registrierung, also ohne Anlage eines Kundenkontos, gew??hlt haben, steht Ihnen diese M??glichkeit nicht zur Verf??gung.',
        ],
    ],
    'PaymentOpen' => [
        'en-GB' => [
            'html' => '
                <div style="font-family:arial; font-size:12px;">
                    <br/>
                        <p>
                            {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},<br/>
                            <br/>
                            the status of your order at {{ salesChannel.name }} (Number: {{order.orderNumber}}) on {{ order.orderDateTime|date }} has changed.<br/>
                            <strong>The new status is as follows: {{order.transactions.first.stateMachineState.name}}.</strong><br/>
                            <br/>
                            You can check the current status of your order on our website under "My account" - "My orders" anytime: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                            </br>
                            However, in case you have purchased without a registration or a customer account, you do not have this option.
                        </p>
                </div>
            ',
            'plain' => '
                {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},

                the status of your order at {{ salesChannel.name }} (Number: {{order.orderNumber}}) on {{ order.orderDateTime|date }}  has changed.
                The new status is as follows: {{order.transactions.first.stateMachineState.name}}.

                You can check the current status of your order on our website under "My account" - "My orders" anytime: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                However, in case you have purchased without a registration or a customer account, you do not have this option.',
        ],
        'de-DE' => [
            'html' => '
                <div style="font-family:arial; font-size:12px;">
                    <br/>
                    <p>
                        {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},<br/>
                        <br/>
                        der Zahlungsstatus f??r Ihre Bestellung bei {{ salesChannel.name }} (Number: {{order.orderNumber}}) vom {{ order.orderDateTime|date }} hat sich ge??ndert.<br/>
                        <strong>Die Bestellung hat jetzt den Zahlungsstatus: {{order.transactions.first.stateMachineState.name}}.</strong><br/>
                        <br/>
                        Den aktuellen Status Ihrer Bestellung k??nnen Sie auch jederzeit auf unserer Webseite im  Bereich "Mein Konto" - "Meine Bestellungen" abrufen: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                        </br>
                        Sollten Sie allerdings den Kauf ohne Registrierung, also ohne Anlage eines Kundenkontos, gew??hlt haben, steht Ihnen diese M??glichkeit nicht zur Verf??gung.
                    </p>
                </div>
            ',
            'plain' => '
                {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},

                der Zahlungsstatus f??r Ihre Bestellung bei {{ salesChannel.name }} (Number: {{order.orderNumber}}) vom {{ order.orderDateTime|date }} hat sich ge??ndert!
                Die Bestellung hat jetzt den Zahlungsstatus: {{order.transactions.first.stateMachineState.name}}.

                Den aktuellen Status Ihrer Bestellung k??nnen Sie auch jederzeit auf unserer Webseite im  Bereich "Mein Konto" - "Meine Bestellungen" abrufen: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                Sollten Sie allerdings den Kauf ohne Registrierung, also ohne Anlage eines Kundenkontos, gew??hlt haben, steht Ihnen diese M??glichkeit nicht zur Verf??gung.',
        ],
    ],
    'PaymentCancelled' => [
        'en-GB' => [
            'html' => '
                <div style="font-family:arial; font-size:12px;">
                    <br/>
                        <p>
                            {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},<br/>
                            <br/>
                            the status of your order at {{ salesChannel.name }} (Number: {{order.orderNumber}}) on {{ order.orderDateTime|date }} has changed.<br/>
                            <strong>The new status is as follows: {{order.transactions.first.stateMachineState.name}}.</strong><br/>
                            <br/>
                            You can check the current status of your order on our website under "My account" - "My orders" anytime: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                            </br>
                            However, in case you have purchased without a registration or a customer account, you do not have this option.
                        </p>
                </div>
            ',
            'plain' => '
                {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},

                the status of your order at {{ salesChannel.name }} (Number: {{order.orderNumber}}) on {{ order.orderDateTime|date }}  has changed.
                The new status is as follows: {{order.transactions.first.stateMachineState.name}}.

                You can check the current status of your order on our website under "My account" - "My orders" anytime: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                However, in case you have purchased without a registration or a customer account, you do not have this option.',
        ],
        'de-DE' => [
            'html' => '
                <div style="font-family:arial; font-size:12px;">
                    <br/>
                    <p>
                       {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},<br/>
                       <br/>
                       der Zahlungsstatus f??r Ihre Bestellung bei {{ salesChannel.name }} (Number: {{order.orderNumber}}) vom {{ order.orderDateTime|date }} hat sich ge??ndert.<br/>
                       <strong>Die Bestellung hat jetzt den Zahlungsstatus: {{order.transactions.first.stateMachineState.name}}.</strong><br/>
                       <br/>
                        Den aktuellen Status Ihrer Bestellung k??nnen Sie auch jederzeit auf unserer Webseite im  Bereich "Mein Konto" - "Meine Bestellungen" abrufen: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                        </br>
                        Sollten Sie allerdings den Kauf ohne Registrierung, also ohne Anlage eines Kundenkontos, gew??hlt haben, steht Ihnen diese M??glichkeit nicht zur Verf??gung.
                    </p>
                </div>
            ',
            'plain' => '
                {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},

                der Zahlungsstatus f??r Ihre Bestellung bei {{ salesChannel.name }} (Number: {{order.orderNumber}}) vom {{ order.orderDateTime|date }} hat sich ge??ndert!
                Die Bestellung hat jetzt den Zahlungsstatus: {{order.transactions.first.stateMachineState.name}}.

                Den aktuellen Status Ihrer Bestellung k??nnen Sie auch jederzeit auf unserer Webseite im  Bereich "Mein Konto" - "Meine Bestellungen" abrufen: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                Sollten Sie allerdings den Kauf ohne Registrierung, also ohne Anlage eines Kundenkontos, gew??hlt haben, steht Ihnen diese M??glichkeit nicht zur Verf??gung.',
        ],
    ],
    'PaymentPaidPartially' => [
        'en-GB' => [
            'html' => '
                <div style="font-family:arial; font-size:12px;">
                    <br/>
                        <p>
                            {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},<br/>
                            <br/>
                            the status of your order at {{ salesChannel.name }} (Number: {{order.orderNumber}}) on {{ order.orderDateTime|date }} has changed.<br/>
                            <strong>The new status is as follows: {{order.transactions.first.stateMachineState.name}}.</strong><br/>
                            <br/>
                            You can check the current status of your order on our website under "My account" - "My orders" anytime: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                            </br>
                            However, in case you have purchased without a registration or a customer account, you do not have this option.
                        </p>
                </div>
            ',
            'plain' => '
                {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},

                the status of your order at {{ salesChannel.name }} (Number: {{order.orderNumber}}) on {{ order.orderDateTime|date }}  has changed.
                The new status is as follows: {{order.transactions.first.stateMachineState.name}}.

                You can check the current status of your order on our website under "My account" - "My orders" anytime: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                However, in case you have purchased without a registration or a customer account, you do not have this option.',
        ],
        'de-DE' => [
            'html' => '
                <div style="font-family:arial; font-size:12px;">
                    <br/>
                    <p>
                        {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},<br/>
                        <br/>
                        der Zahlungsstatus f??r Ihre Bestellung bei {{ salesChannel.name }} (Number: {{order.orderNumber}}) vom {{ order.orderDateTime|date }} hat sich ge??ndert.<br/>
                        <strong>Die Bestellung hat jetzt den Zahlungsstatus: {{order.transactions.first.stateMachineState.name}}.</strong><br/>
                        <br/>
                        Den aktuellen Status Ihrer Bestellung k??nnen Sie auch jederzeit auf unserer Webseite im  Bereich "Mein Konto" - "Meine Bestellungen" abrufen: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                        </br>
                        Sollten Sie allerdings den Kauf ohne Registrierung, also ohne Anlage eines Kundenkontos, gew??hlt haben, steht Ihnen diese M??glichkeit nicht zur Verf??gung.
                    </p>
                </div>
            ',
            'plain' => '
                {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},

                der Zahlungsstatus f??r Ihre Bestellung bei {{ salesChannel.name }} (Number: {{order.orderNumber}}) vom {{ order.orderDateTime|date }} hat sich ge??ndert!
                Die Bestellung hat jetzt den Zahlungsstatus: {{order.transactions.first.stateMachineState.name}}.

                Den aktuellen Status Ihrer Bestellung k??nnen Sie auch jederzeit auf unserer Webseite im  Bereich "Mein Konto" - "Meine Bestellungen" abrufen: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                Sollten Sie allerdings den Kauf ohne Registrierung, also ohne Anlage eines Kundenkontos, gew??hlt haben, steht Ihnen diese M??glichkeit nicht zur Verf??gung.',
        ],
    ],
    'PaymentPaid' => [
        'en-GB' => [
            'html' => '
                <div style="font-family:arial; font-size:12px;">
                    <br/>
                        <p>
                            {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},<br/>
                            <br/>
                            the status of your order at {{ salesChannel.name }} (Number: {{order.orderNumber}}) on {{ order.orderDateTime|date }} has changed.<br/>
                            <strong>The new status is as follows: {{order.transactions.first.stateMachineState.name}}.</strong><br/>
                            <br/>
                            You can check the current status of your order on our website under "My account" - "My orders" anytime: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                            </br>
                            However, in case you have purchased without a registration or a customer account, you do not have this option.
                        </p>
                </div>
            ',
            'plain' => '
                {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},

                the status of your order at {{ salesChannel.name }} (Number: {{order.orderNumber}}) on {{ order.orderDateTime|date }}  has changed.
                The new status is as follows: {{order.transactions.first.stateMachineState.name}}.

                You can check the current status of your order on our website under "My account" - "My orders" anytime: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                However, in case you have purchased without a registration or a customer account, you do not have this option.',
        ],
        'de-DE' => [
            'html' => '
                <div style="font-family:arial; font-size:12px;">
                    <br/>
                    <p>
                        {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},<br/>
                        <br/>
                        der Zahlungsstatus f??r Ihre Bestellung bei {{ salesChannel.name }} (Number: {{order.orderNumber}}) vom {{ order.orderDateTime|date }} hat sich ge??ndert.<br/>
                        <strong>Die Bestellung hat jetzt den Zahlungsstatus: {{order.transactions.first.stateMachineState.name}}.</strong><br/>
                        <br/>
                        Den aktuellen Status Ihrer Bestellung k??nnen Sie auch jederzeit auf unserer Webseite im  Bereich "Mein Konto" - "Meine Bestellungen" abrufen: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                        </br>
                        Sollten Sie allerdings den Kauf ohne Registrierung, also ohne Anlage eines Kundenkontos, gew??hlt haben, steht Ihnen diese M??glichkeit nicht zur Verf??gung.
                    </p>
                </div>
            ',
            'plain' => '
                {{order.orderCustomer.salutation.letterName }} {{order.orderCustomer.firstName}} {{order.orderCustomer.lastName}},

                der Zahlungsstatus f??r Ihre Bestellung bei {{ salesChannel.name }} (Number: {{order.orderNumber}}) vom {{ order.orderDateTime|date }} hat sich ge??ndert!
                Die Bestellung hat jetzt den Zahlungsstatus: {{order.transactions.first.stateMachineState.name}}.

                Den aktuellen Status Ihrer Bestellung k??nnen Sie auch jederzeit auf unserer Webseite im  Bereich "Mein Konto" - "Meine Bestellungen" abrufen: {{ rawUrl(\'frontend.account.order.single.page\', { \'deepLinkCode\': order.deepLinkCode}, salesChannel.domains|first.url) }}
                Sollten Sie allerdings den Kauf ohne Registrierung, also ohne Anlage eines Kundenkontos, gew??hlt haben, steht Ihnen diese M??glichkeit nicht zur Verf??gung.',
        ],
    ],
    'customer.group.registration.accepted' => [
        'en-GB' => [
            'html' => '<div style="font-family:arial; font-size:12px;">
                    <br/>
                    <p>
                        {{ customer.salutation.letterName }} {{ customer.lastName }},<br/>
                        <br/>
                        Your account has been activated for the customer group {{ customerGroup.translated.name }}.<br/>
                        From now on you can shop at the new conditions of this customer group.<br/><br/>

                        Please do not hesitate to contact us at any time if you have any questions.
                    </p>
                </div>',
            'plain' => 'Hello {{ customer.salutation.letterName }} {{ customer.lastName }},<br/>
Your account has been activated for the customer group {{ customerGroup.translated.name }}.<br/>
From now on you can shop at the new conditions of this customer group.<br/><br/>

Please do not hesitate to contact us at any time if you have any questions.',
        ],
        'de-DE' => [
            'html' => '<div style="font-family:arial; font-size:12px;">
                <br/>
                <p>
                    {{ customer.salutation.letterName }} {{ customer.lastName }},<br/>
                    <br/>
                    Ihr Account wurde f??r die Kundengruppe {{ customerGroup.translated.name }} freigeschaltet.<br/>
                    Ab sofort kaufen Sie zu den neuen Konditionen dieser Kundengruppe ein.<br/>

                    F??r R??ckfragen stehen wir Ihnen jederzeit gerne zur Verf??gung.
                </p>
            </div>',
            'plain' => '{{ customer.salutation.letterName }} {{ customer.lastName }},<br/>
Ihr Account wurde f??r die Kundengruppe {{ customerGroup.translated.name }} freigeschaltet.
Ab sofort kaufen Sie zu den neuen Konditionen dieser Kundengruppe ein.<br/><br/>

F??r R??ckfragen stehen wir Ihnen jederzeit gerne zur Verf??gung.',
        ],
    ],
    'customer.group.registration.declined' => [
        'en-GB' => [
            'html' => '<div style="font-family:arial; font-size:12px;">
                    <br/>
                    <p>
                        {{ customer.salutation.letterName }} {{ customer.lastName }},<br/>
                        <br/>
                        Thank you for your interest in the conditions for customer group {{ customerGroup.translated.name }}.<br/>
                        Unfortunately we cannot activate your account for this customer group.<br/><br/>

                        If you have any questions, please feel free to contact us by phone or mail.
                    </p>
                </div>',
            'plain' => '{{ customer.salutation.letterName }} {{ customer.lastName }},<br/>
Thank you for your interest in the conditions for customer group {{ customerGroup.translated.name }}.<br/>
Unfortunately we cannot activate your account for this customer group.

If you have any questions, please feel free to contact us by phone or mail.',
        ],
        'de-DE' => [
            'html' => '<div style="font-family:arial; font-size:12px;">
                <br/>
                <p>
                    {{ customer.salutation.letterName }} {{ customer.lastName }},<br/>
                    <br/>
                    Vielen Dank f??r Ihr Interesse an den Konditionen f??r Kundengruppe {{ customerGroup.translated.name }}.<br/>
                    Leider k??nnen wir sie nicht f??r diese Kundengruppe freischalten.<br/>

                    Bei R??ckfragen aller Art k??nnen Sie uns gerne telefonisch oder per Mail diesbez??glich erreichen.
                </p>
            </div>',
            'plain' => '{{ customer.salutation.letterName }} {{ customer.lastName }},<br/>
Vielen Dank f??r Ihr Interesse an den Konditionen f??r Kundengruppe  {{ customerGroup.translated.name }}.
Leider k??nnen wir sie nicht f??r diese Kundengruppe freischalten.<br/>

Bei R??ckfragen aller Art k??nnen Sie uns gerne telefonisch oder per Mail diesbez??glich erreichen.',
        ],
    ],
];
