<link rel="stylesheet" href="https://js.stripe.com/v3/fingerprinted/css/checkout-app-init-a59f9edd2a2678d7dbb00eb242cc24a6.css">
<div class="App-Container is-noBackground flex-container justify-content-center">
    <div class="App App--singleItem">
        <div class="App-Overview">
            <header class="Header">
                <div class="Header-Content flex-container justify-content-space-between align-items-stretch">
                    <div class="Header-business flex-item width-grow flex-container align-items-center"><a
                            class="Link Header-businessLink Link--primary" href="http://deals.com/deals"
                            aria-label="Previous page" title="Sk Designs" target="_self">
                            <div style="position: relative;">
                                <div class="flex-container align-items-center">
                                    <div class="Header-backArrowContainer" style="opacity: 1; transform: none;"><svg
                                            class="InlineSVG Icon Header-backArrow mr2 Icon--sm" focusable="false"
                                            width="12" height="12" viewBox="0 0 16 16">
                                            <path
                                                d="M3.417 7H15a1 1 0 0 1 0 2H3.417l4.591 4.591a1 1 0 0 1-1.415 1.416l-6.3-6.3a1 1 0 0 1 0-1.414l6.3-6.3A1 1 0 0 1 8.008 2.41z"
                                                fill-rule="evenodd"></path>
                                        </svg></div>
                                    <div class="Header-merchantLogoContainer" style="transform: none;">
                                        <div class="Header-merchantLogoWithLabel flex-item width-grow">
                                            <div
                                                class="HeaderImage HeaderImage--icon HeaderImage--iconFallback flex-item width-fixed flex-container justify-content-center align-items-center width-fixed">
                                                <svg class="InlineSVG Icon HeaderImage-fallbackIcon Icon--sm"
                                                    focusable="false" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3 7.5V12h10V7.5c.718 0 1.398-.168 2-.468V15a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V7.032c.602.3 1.282.468 2 .468zM0 3L1.703.445A1 1 0 0 1 2.535 0h10.93a1 1 0 0 1 .832.445L16 3a3 3 0 0 1-5.5 1.659C9.963 5.467 9.043 6 8 6s-1.963-.533-2.5-1.341A3 3 0 0 1 0 3z"
                                                        fill-rule="evenodd"></path>
                                                </svg></div><span
                                                class="Header-businessLink-label Text Text-color--gray800 Text-fontSize--14 Text-fontWeight--500">Back</span>
                                            <h1
                                                class="Header-businessLink-name Text Text-color--gray800 Text-fontSize--14 Text-fontWeight--500 Text--truncate">
                                                Sk Designs</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="mx2 flex-item width-fixed">
                            <div class="Tag Header-testTag Tag-orange"><span
                                    class="Text Text-color--orange Text-fontSize--11 Text-fontWeight--700 Text-transform--uppercase">Test
                                    Mode</span></div>
                            <div class="Tag Header-testTagMobile Tag-orange"><span
                                    class="Text Text-color--orange Text-fontSize--11 Text-fontWeight--700 Text-transform--uppercase">Test</span>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div class="App-productSummaryContainer">
                <div class="ProductSummary no-image">
                    <div class="ProductSummary-info"><span
                            class="Text Text-color--gray500 Text-fontSize--16 Text-fontWeight--500">T-shirt</span><span
                            class="ProductSummary-totalAmount Text Text-color--default Text-fontWeight--600 Text--tabularNumbers"
                            id="ProductSummary-totalAmount">{{$session->amount_total}} / 100</span><span
                            class="ProductSummary-description Text Text-color--gray500 Text-fontSize--14 Text-fontWeight--500"
                            id="ProductSummary-description">
                            <div class="ProductSummaryDescription ProductSummaryDescription--singleItem"></div>
                        </span></div>

                        {{$session}}
                        {{Auth::user()->email}}
                </div>
            </div>
        </div>
        <div class="App-Payment">
            <div class="CheckoutPaymentForm">
                <div class="PaymentRequestOrHeader" style="height: auto;">
                    <div class="PaymentHeaderContainer" style="display: block; opacity: 1;">
                        <div class="PaymentHeader">
                            <div class="Text Text-color--default Text-fontSize--20 Text-fontWeight--500">Pay with card
                            </div>
                        </div>
                    </div>
                    <div class="ButtonAndDividerContainer" style="opacity: 0; display: none;"></div>
                </div>
                <div class="PaymentFormFixedHeightContainer flex-container direction-column" style="height: 474px;">
                    <form novalidate="">
                        <div class="App-Global-Fields flex-container spacing-16 direction-row wrap-wrap">
                            <div class="flex-item width-12">
                                <div class="FormFieldGroup" data-qa="FormFieldGroup-email">
                                    <div
                                        class="FormFieldGroup-labelContainer flex-container justify-content-space-between">
                                        <label for="email"><span
                                                class="Text Text-color--gray600 Text-fontSize--13 Text-fontWeight--500">Email</span></label>
                                        <div style="opacity: 1; transform: none;"></div>
                                    </div>
                                    <div class="FormFieldGroup-Fieldset" id="email-fieldset">
                                        <div class="FormFieldGroup-container">
                                            <div
                                                class="FormFieldGroup-child FormFieldGroup-child--width-12 FormFieldGroup-childLeft FormFieldGroup-childRight FormFieldGroup-childTop FormFieldGroup-childBottom">
                                                <div class="FormFieldInput">
                                                    <div class="CheckoutInputContainer"><span class="InputContainer"
                                                            data-max=""><input class="CheckoutInput Input Input--empty"
                                                                autocomplete="email" autocorrect="off"
                                                                spellcheck="false" id="email" name="email" type="text"
                                                                inputmode="email" autocapitalize="none"
                                                                aria-invalid="false" aria-describedby=""
                                                                value=""></span></div>
                                                </div>
                                            </div>
                                            <div style="opacity: 0; height: 0px;"><span
                                                    class="FieldError Text Text-color--red Text-fontSize--13"><span
                                                        aria-hidden="true"></span></span></div>
                                        </div>
                                        <div style="opacity: 0; height: 0px;"><span
                                                class="FieldError Text Text-color--red Text-fontSize--13"><span
                                                    aria-hidden="true"></span></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="PaymentForm-paymentMethodForm flex-container spacing-16 direction-column wrap-wrap">
                            <div class="flex-item width-12">
                                <div class="FormFieldGroup">
                                    <div
                                        class="FormFieldGroup-labelContainer flex-container justify-content-space-between">
                                        <label for="cardNumber-fieldset"><span
                                                class="Text Text-color--gray600 Text-fontSize--13 Text-fontWeight--500">Card
                                                information</span></label></div>
                                    <fieldset class="FormFieldGroup-Fieldset" id="cardNumber-fieldset">
                                        <div class="FormFieldGroup-container" id="cardNumber-fieldset">
                                            <div
                                                class="FormFieldGroup-child FormFieldGroup-child--width-12 FormFieldGroup-childLeft FormFieldGroup-childRight FormFieldGroup-childTop">
                                                <div class="FormFieldInput">
                                                    <div class="CheckoutInputContainer"><span class="InputContainer"
                                                            data-max=""><input
                                                                class="CheckoutInput CheckoutInput--tabularnums Input Input--empty"
                                                                autocomplete="cc-number" autocorrect="off"
                                                                spellcheck="false" id="cardNumber" name="cardNumber"
                                                                type="text" inputmode="numeric" aria-label="Card number"
                                                                placeholder="1234 1234 1234 1234" aria-invalid="false"
                                                                value=""></span></div>
                                                    <div class="FormFieldInput-Icons" style="opacity: 1;">
                                                        <div style="transform: none;"><span
                                                                class="FormFieldInput-IconsIcon is-visible"><img
                                                                    src="https://js.stripe.com/v3/fingerprinted/img/visa-365725566f9578a9589553aa9296d178.svg"
                                                                    alt="visa" class="BrandIcon"></span></div>
                                                        <div style="transform: none;"><span
                                                                class="FormFieldInput-IconsIcon is-visible"><img
                                                                    src="https://js.stripe.com/v3/fingerprinted/img/mastercard-4d8844094130711885b5e41b28c9848f.svg"
                                                                    alt="mastercard" class="BrandIcon"></span></div>
                                                        <div style="transform: none;"><span
                                                                class="FormFieldInput-IconsIcon is-visible"><img
                                                                    src="https://js.stripe.com/v3/fingerprinted/img/amex-a49b82f46c5cd6a96a6e418a6ca1717c.svg"
                                                                    alt="amex" class="BrandIcon"></span></div>
                                                        <div class="CardFormFieldGroupIconOverflow"><span
                                                                class="CardFormFieldGroupIconOverflow-Item CardFormFieldGroupIconOverflow-Item--invisible"
                                                                role="presentation"><span
                                                                    class="FormFieldInput-IconsIcon"
                                                                    role="presentation"><img
                                                                        src="https://js.stripe.com/v3/fingerprinted/img/unionpay-8a10aefc7295216c338ba4e1224627a1.svg"
                                                                        alt="unionpay"
                                                                        class="BrandIcon"></span></span><span
                                                                class="CardFormFieldGroupIconOverflow-Item CardFormFieldGroupIconOverflow-Item--invisible"
                                                                role="presentation"><span
                                                                    class="FormFieldInput-IconsIcon"
                                                                    role="presentation"><img
                                                                        src="https://js.stripe.com/v3/fingerprinted/img/jcb-271fd06e6e7a2c52692ffa91a95fb64f.svg"
                                                                        alt="jcb" class="BrandIcon"></span></span><span
                                                                class="CardFormFieldGroupIconOverflow-Item CardFormFieldGroupIconOverflow-Item--invisible"
                                                                role="presentation"><span
                                                                    class="FormFieldInput-IconsIcon"
                                                                    role="presentation"><img
                                                                        src="https://js.stripe.com/v3/fingerprinted/img/discover-ac52cd46f89fa40a29a0bfb954e33173.svg"
                                                                        alt="discover"
                                                                        class="BrandIcon"></span></span><span
                                                                class="CardFormFieldGroupIconOverflow-Item CardFormFieldGroupIconOverflow-Item--visible"
                                                                role="presentation"><span
                                                                    class="FormFieldInput-IconsIcon"
                                                                    role="presentation"><img
                                                                        src="https://js.stripe.com/v3/fingerprinted/img/diners-fbcbd3360f8e3f629cdaa80e93abdb8b.svg"
                                                                        alt="diners" class="BrandIcon"></span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="FormFieldGroup-child FormFieldGroup-child--width-6 FormFieldGroup-childLeft FormFieldGroup-childBottom">
                                                <div class="FormFieldInput">
                                                    <div class="CheckoutInputContainer"><span class="InputContainer"
                                                            data-max=""><input
                                                                class="CheckoutInput CheckoutInput--tabularnums Input Input--empty"
                                                                autocomplete="cc-exp" autocorrect="off"
                                                                spellcheck="false" id="cardExpiry" name="cardExpiry"
                                                                type="text" inputmode="numeric" aria-label="Expiration"
                                                                placeholder="MM / YY" aria-invalid="false"
                                                                value=""></span></div>
                                                </div>
                                            </div>
                                            <div
                                                class="FormFieldGroup-child FormFieldGroup-child--width-6 FormFieldGroup-childRight FormFieldGroup-childBottom">
                                                <div class="FormFieldInput has-icon">
                                                    <div class="CheckoutInputContainer"><span class="InputContainer"
                                                            data-max=""><input
                                                                class="CheckoutInput CheckoutInput--tabularnums Input Input--empty"
                                                                autocomplete="cc-csc" autocorrect="off"
                                                                spellcheck="false" id="cardCvc" name="cardCvc"
                                                                type="text" inputmode="numeric" aria-label="CVC"
                                                                placeholder="CVC" aria-invalid="false" value=""></span>
                                                    </div>
                                                    <div class="FormFieldInput-Icon is-loaded"><svg
                                                            class="Icon Icon--md" focusable="false" viewBox="0 0 32 21">
                                                            <g fill="none" fill-rule="evenodd">
                                                                <g class="Icon-fill">
                                                                    <g transform="translate(0 2)">
                                                                        <path
                                                                            d="M21.68 0H2c-.92 0-2 1.06-2 2v15c0 .94 1.08 2 2 2h25c.92 0 2-1.06 2-2V9.47a5.98 5.98 0 0 1-3 1.45V11c0 .66-.36 1-1 1H3c-.64 0-1-.34-1-1v-1c0-.66.36-1 1-1h17.53a5.98 5.98 0 0 1 1.15-9z"
                                                                            opacity=".2"></path>
                                                                        <path
                                                                            d="M19.34 3H0v3h19.08a6.04 6.04 0 0 1 .26-3z"
                                                                            opacity=".3"></path>
                                                                    </g>
                                                                    <g transform="translate(18)">
                                                                        <path
                                                                            d="M7 14A7 7 0 1 1 7 0a7 7 0 0 1 0 14zM4.22 4.1h-.79l-1.93.98v1l1.53-.8V9.9h1.2V4.1zm2.3.8c.57 0 .97.32.97.78 0 .5-.47.85-1.15.85h-.3v.85h.36c.72 0 1.21.36 1.21.88 0 .5-.48.84-1.16.84-.5 0-1-.16-1.52-.47v1c.56.24 1.12.37 1.67.37 1.31 0 2.21-.67 2.21-1.64 0-.68-.42-1.23-1.12-1.45.6-.2.99-.73.99-1.33C8.68 4.64 7.85 4 6.65 4a4 4 0 0 0-1.57.34v.98c.48-.27.97-.42 1.44-.42zm4.32 2.18c.73 0 1.24.43 1.24.99 0 .59-.51 1-1.24 1-.44 0-.9-.14-1.37-.43v1.03c.49.22.99.33 1.48.33.26 0 .5-.04.73-.1.52-.85.82-1.83.82-2.88l-.02-.42a2.3 2.3 0 0 0-1.23-.32c-.18 0-.37.01-.57.04v-1.3h1.44a5.62 5.62 0 0 0-.46-.92H9.64v3.15c.4-.1.8-.17 1.2-.17z">
                                                                        </path>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </svg></div>
                                                </div>
                                            </div>
                                            <div style="opacity: 0; height: 0px;"><span
                                                    class="FieldError Text Text-color--red Text-fontSize--13"><span
                                                        aria-hidden="true"></span></span></div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="billing-container flex-item width-12" aria-hidden="false">
                                <div style="pointer-events: auto; height: auto; opacity: 1;">
                                    <div class="flex-container spacing-16 direction-row wrap-wrap">
                                        <div class="flex-item width-12">
                                            <div class="FormFieldGroup">
                                                <div
                                                    class="FormFieldGroup-labelContainer flex-container justify-content-space-between">
                                                    <label for="billingName"><span
                                                            class="Text Text-color--gray600 Text-fontSize--13 Text-fontWeight--500">Name
                                                            on card</span></label></div>
                                                <div class="FormFieldGroup-Fieldset">
                                                    <div class="FormFieldGroup-container" id="billingName-fieldset">
                                                        <div
                                                            class="FormFieldGroup-child FormFieldGroup-child--width-12 FormFieldGroup-childLeft FormFieldGroup-childRight FormFieldGroup-childTop FormFieldGroup-childBottom">
                                                            <div class="FormFieldInput">
                                                                <div class="CheckoutInputContainer"><span
                                                                        class="InputContainer" data-max=""><input
                                                                            class="CheckoutInput Input Input--empty"
                                                                            autocomplete="ccname" autocorrect="off"
                                                                            spellcheck="false" id="billingName"
                                                                            name="billingName" type="text"
                                                                            aria-invalid="false" value=""></span></div>
                                                            </div>
                                                        </div>
                                                        <div style="opacity: 0; height: 0px;"><span
                                                                class="FieldError Text Text-color--red Text-fontSize--13"><span
                                                                    aria-hidden="true"></span></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-item width-12">
                                            <div class="FormFieldGroup">
                                                <div
                                                    class="FormFieldGroup-labelContainer flex-container justify-content-space-between">
                                                    <label for="country"><span
                                                            class="Text Text-color--gray600 Text-fontSize--13 Text-fontWeight--500">Country
                                                            or region</span></label></div>
                                                <div class="FormFieldGroup-Fieldset">
                                                    <div class="FormFieldGroup-container FormFieldGroup-container--supportTransitions"
                                                        id="country-fieldset">
                                                        <div
                                                            class="FormFieldGroup-child FormFieldGroup-child--width-12 FormFieldGroup-childLeft FormFieldGroup-childRight FormFieldGroup-childTop FormFieldGroup-childBottom">
                                                            <div class="FormFieldInput is-select">
                                                                <div>
                                                                    <div class="Select"><select id="billingCountry"
                                                                            name="billingCountry"
                                                                            autocomplete="billing country"
                                                                            aria-label="Country or region"
                                                                            class="Select-source">
                                                                            <option value="" disabled="" hidden="">
                                                                            </option>
                                                                            <option value="AF">Afghanistan</option>
                                                                            <option value="AX">Åland Islands</option>
                                                                            <option value="AL">Albania</option>
                                                                            <option value="DZ">Algeria</option>
                                                                            <option value="AD">Andorra</option>
                                                                            <option value="AO">Angola</option>
                                                                            <option value="AI">Anguilla</option>
                                                                            <option value="AQ">Antarctica</option>
                                                                            <option value="AG">Antigua &amp; Barbuda
                                                                            </option>
                                                                            <option value="AR">Argentina</option>
                                                                            <option value="AM">Armenia</option>
                                                                            <option value="AW">Aruba</option>
                                                                            <option value="AC">Ascension Island</option>
                                                                            <option value="AU">Australia</option>
                                                                            <option value="AT">Austria</option>
                                                                            <option value="AZ">Azerbaijan</option>
                                                                            <option value="BS">Bahamas</option>
                                                                            <option value="BH">Bahrain</option>
                                                                            <option value="BD">Bangladesh</option>
                                                                            <option value="BB">Barbados</option>
                                                                            <option value="BY">Belarus</option>
                                                                            <option value="BE">Belgium</option>
                                                                            <option value="BZ">Belize</option>
                                                                            <option value="BJ">Benin</option>
                                                                            <option value="BM">Bermuda</option>
                                                                            <option value="BT">Bhutan</option>
                                                                            <option value="BO">Bolivia</option>
                                                                            <option value="BA">Bosnia &amp; Herzegovina
                                                                            </option>
                                                                            <option value="BW">Botswana</option>
                                                                            <option value="BV">Bouvet Island</option>
                                                                            <option value="BR">Brazil</option>
                                                                            <option value="IO">British Indian Ocean
                                                                                Territory</option>
                                                                            <option value="VG">British Virgin Islands
                                                                            </option>
                                                                            <option value="BN">Brunei</option>
                                                                            <option value="BG">Bulgaria</option>
                                                                            <option value="BF">Burkina Faso</option>
                                                                            <option value="BI">Burundi</option>
                                                                            <option value="KH">Cambodia</option>
                                                                            <option value="CM">Cameroon</option>
                                                                            <option value="CA">Canada</option>
                                                                            <option value="CV">Cape Verde</option>
                                                                            <option value="BQ">Caribbean Netherlands
                                                                            </option>
                                                                            <option value="KY">Cayman Islands</option>
                                                                            <option value="CF">Central African Republic
                                                                            </option>
                                                                            <option value="TD">Chad</option>
                                                                            <option value="CL">Chile</option>
                                                                            <option value="CN">China</option>
                                                                            <option value="CO">Colombia</option>
                                                                            <option value="KM">Comoros</option>
                                                                            <option value="CG">Congo - Brazzaville
                                                                            </option>
                                                                            <option value="CD">Congo - Kinshasa</option>
                                                                            <option value="CK">Cook Islands</option>
                                                                            <option value="CR">Costa Rica</option>
                                                                            <option value="CI">Côte d’Ivoire</option>
                                                                            <option value="HR">Croatia</option>
                                                                            <option value="CW">Curaçao</option>
                                                                            <option value="CY">Cyprus</option>
                                                                            <option value="CZ">Czechia</option>
                                                                            <option value="DK">Denmark</option>
                                                                            <option value="DJ">Djibouti</option>
                                                                            <option value="DM">Dominica</option>
                                                                            <option value="DO">Dominican Republic
                                                                            </option>
                                                                            <option value="EC">Ecuador</option>
                                                                            <option value="EG">Egypt</option>
                                                                            <option value="SV">El Salvador</option>
                                                                            <option value="GQ">Equatorial Guinea
                                                                            </option>
                                                                            <option value="ER">Eritrea</option>
                                                                            <option value="EE">Estonia</option>
                                                                            <option value="SZ">Eswatini</option>
                                                                            <option value="ET">Ethiopia</option>
                                                                            <option value="FK">Falkland Islands</option>
                                                                            <option value="FO">Faroe Islands</option>
                                                                            <option value="FJ">Fiji</option>
                                                                            <option value="FI">Finland</option>
                                                                            <option value="FR">France</option>
                                                                            <option value="GF">French Guiana</option>
                                                                            <option value="PF">French Polynesia</option>
                                                                            <option value="TF">French Southern
                                                                                Territories</option>
                                                                            <option value="GA">Gabon</option>
                                                                            <option value="GM">Gambia</option>
                                                                            <option value="GE">Georgia</option>
                                                                            <option value="DE">Germany</option>
                                                                            <option value="GH">Ghana</option>
                                                                            <option value="GI">Gibraltar</option>
                                                                            <option value="GR">Greece</option>
                                                                            <option value="GL">Greenland</option>
                                                                            <option value="GD">Grenada</option>
                                                                            <option value="GP">Guadeloupe</option>
                                                                            <option value="GU">Guam</option>
                                                                            <option value="GT">Guatemala</option>
                                                                            <option value="GG">Guernsey</option>
                                                                            <option value="GN">Guinea</option>
                                                                            <option value="GW">Guinea-Bissau</option>
                                                                            <option value="GY">Guyana</option>
                                                                            <option value="HT">Haiti</option>
                                                                            <option value="HN">Honduras</option>
                                                                            <option value="HK">Hong Kong SAR China
                                                                            </option>
                                                                            <option value="HU">Hungary</option>
                                                                            <option value="IS">Iceland</option>
                                                                            <option value="IN">India</option>
                                                                            <option value="ID">Indonesia</option>
                                                                            <option value="IQ">Iraq</option>
                                                                            <option value="IE">Ireland</option>
                                                                            <option value="IM">Isle of Man</option>
                                                                            <option value="IL">Israel</option>
                                                                            <option value="IT">Italy</option>
                                                                            <option value="JM">Jamaica</option>
                                                                            <option value="JP">Japan</option>
                                                                            <option value="JE">Jersey</option>
                                                                            <option value="JO">Jordan</option>
                                                                            <option value="KZ">Kazakhstan</option>
                                                                            <option value="KE">Kenya</option>
                                                                            <option value="KI">Kiribati</option>
                                                                            <option value="XK">Kosovo</option>
                                                                            <option value="KW">Kuwait</option>
                                                                            <option value="KG">Kyrgyzstan</option>
                                                                            <option value="LA">Laos</option>
                                                                            <option value="LV">Latvia</option>
                                                                            <option value="LB">Lebanon</option>
                                                                            <option value="LS">Lesotho</option>
                                                                            <option value="LR">Liberia</option>
                                                                            <option value="LY">Libya</option>
                                                                            <option value="LI">Liechtenstein</option>
                                                                            <option value="LT">Lithuania</option>
                                                                            <option value="LU">Luxembourg</option>
                                                                            <option value="MO">Macao SAR China</option>
                                                                            <option value="MG">Madagascar</option>
                                                                            <option value="MW">Malawi</option>
                                                                            <option value="MY">Malaysia</option>
                                                                            <option value="MV">Maldives</option>
                                                                            <option value="ML">Mali</option>
                                                                            <option value="MT">Malta</option>
                                                                            <option value="MQ">Martinique</option>
                                                                            <option value="MR">Mauritania</option>
                                                                            <option value="MU">Mauritius</option>
                                                                            <option value="YT">Mayotte</option>
                                                                            <option value="MX">Mexico</option>
                                                                            <option value="MD">Moldova</option>
                                                                            <option value="MC">Monaco</option>
                                                                            <option value="MN">Mongolia</option>
                                                                            <option value="ME">Montenegro</option>
                                                                            <option value="MS">Montserrat</option>
                                                                            <option value="MA">Morocco</option>
                                                                            <option value="MZ">Mozambique</option>
                                                                            <option value="MM">Myanmar (Burma)</option>
                                                                            <option value="NA">Namibia</option>
                                                                            <option value="NR">Nauru</option>
                                                                            <option value="NP">Nepal</option>
                                                                            <option value="NL">Netherlands</option>
                                                                            <option value="NC">New Caledonia</option>
                                                                            <option value="NZ">New Zealand</option>
                                                                            <option value="NI">Nicaragua</option>
                                                                            <option value="NE">Niger</option>
                                                                            <option value="NG">Nigeria</option>
                                                                            <option value="NU">Niue</option>
                                                                            <option value="MK">North Macedonia</option>
                                                                            <option value="NO">Norway</option>
                                                                            <option value="OM">Oman</option>
                                                                            <option value="PK">Pakistan</option>
                                                                            <option value="PS">Palestinian Territories
                                                                            </option>
                                                                            <option value="PA">Panama</option>
                                                                            <option value="PG">Papua New Guinea</option>
                                                                            <option value="PY">Paraguay</option>
                                                                            <option value="PE">Peru</option>
                                                                            <option value="PH">Philippines</option>
                                                                            <option value="PN">Pitcairn Islands</option>
                                                                            <option value="PL">Poland</option>
                                                                            <option value="PT">Portugal</option>
                                                                            <option value="PR">Puerto Rico</option>
                                                                            <option value="QA">Qatar</option>
                                                                            <option value="RE">Réunion</option>
                                                                            <option value="RO">Romania</option>
                                                                            <option value="RU">Russia</option>
                                                                            <option value="RW">Rwanda</option>
                                                                            <option value="WS">Samoa</option>
                                                                            <option value="SM">San Marino</option>
                                                                            <option value="ST">São Tomé &amp; Príncipe
                                                                            </option>
                                                                            <option value="SA">Saudi Arabia</option>
                                                                            <option value="SN">Senegal</option>
                                                                            <option value="RS">Serbia</option>
                                                                            <option value="SC">Seychelles</option>
                                                                            <option value="SL">Sierra Leone</option>
                                                                            <option value="SG">Singapore</option>
                                                                            <option value="SX">Sint Maarten</option>
                                                                            <option value="SK">Slovakia</option>
                                                                            <option value="SI">Slovenia</option>
                                                                            <option value="SB">Solomon Islands</option>
                                                                            <option value="SO">Somalia</option>
                                                                            <option value="ZA">South Africa</option>
                                                                            <option value="GS">South Georgia &amp; South
                                                                                Sandwich Islands</option>
                                                                            <option value="KR">South Korea</option>
                                                                            <option value="SS">South Sudan</option>
                                                                            <option value="ES">Spain</option>
                                                                            <option value="LK">Sri Lanka</option>
                                                                            <option value="BL">St. Barthélemy</option>
                                                                            <option value="SH">St. Helena</option>
                                                                            <option value="KN">St. Kitts &amp; Nevis
                                                                            </option>
                                                                            <option value="LC">St. Lucia</option>
                                                                            <option value="MF">St. Martin</option>
                                                                            <option value="PM">St. Pierre &amp; Miquelon
                                                                            </option>
                                                                            <option value="VC">St. Vincent &amp;
                                                                                Grenadines</option>
                                                                            <option value="SR">Suriname</option>
                                                                            <option value="SJ">Svalbard &amp; Jan Mayen
                                                                            </option>
                                                                            <option value="SE">Sweden</option>
                                                                            <option value="CH">Switzerland</option>
                                                                            <option value="TW">Taiwan</option>
                                                                            <option value="TJ">Tajikistan</option>
                                                                            <option value="TZ">Tanzania</option>
                                                                            <option value="TH">Thailand</option>
                                                                            <option value="TL">Timor-Leste</option>
                                                                            <option value="TG">Togo</option>
                                                                            <option value="TK">Tokelau</option>
                                                                            <option value="TO">Tonga</option>
                                                                            <option value="TT">Trinidad &amp; Tobago
                                                                            </option>
                                                                            <option value="TA">Tristan da Cunha</option>
                                                                            <option value="TN">Tunisia</option>
                                                                            <option value="TR">Turkey</option>
                                                                            <option value="TM">Turkmenistan</option>
                                                                            <option value="TC">Turks &amp; Caicos
                                                                                Islands</option>
                                                                            <option value="TV">Tuvalu</option>
                                                                            <option value="UG">Uganda</option>
                                                                            <option value="UA">Ukraine</option>
                                                                            <option value="AE">United Arab Emirates
                                                                            </option>
                                                                            <option value="GB">United Kingdom</option>
                                                                            <option value="US">United States</option>
                                                                            <option value="UY">Uruguay</option>
                                                                            <option value="UZ">Uzbekistan</option>
                                                                            <option value="VU">Vanuatu</option>
                                                                            <option value="VA">Vatican City</option>
                                                                            <option value="VE">Venezuela</option>
                                                                            <option value="VN">Vietnam</option>
                                                                            <option value="WF">Wallis &amp; Futuna
                                                                            </option>
                                                                            <option value="EH">Western Sahara</option>
                                                                            <option value="YE">Yemen</option>
                                                                            <option value="ZM">Zambia</option>
                                                                            <option value="ZW">Zimbabwe</option>
                                                                        </select><svg
                                                                            class="InlineSVG Icon Select-arrow Icon--sm"
                                                                            focusable="false" viewBox="0 0 12 12">
                                                                            <path
                                                                                d="M10.193 3.97a.75.75 0 0 1 1.062 1.062L6.53 9.756a.75.75 0 0 1-1.06 0L.745 5.032A.75.75 0 0 1 1.807 3.97L6 8.163l4.193-4.193z"
                                                                                fill-rule="evenodd"></path>
                                                                        </svg></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div style="opacity: 0; height: 0px;"><span
                                                                class="FieldError Text Text-color--red Text-fontSize--13"><span
                                                                    aria-hidden="true"></span></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="CardPayment-SignUpFormContainer"
                                style="pointer-events: auto; height: auto; opacity: 1;">
                                <div class="SignUpForm mb2 p2 flex-item width-12">
                                    <div class="SignUpForm-checkboxContainer">
                                        <div class="FormFieldCheckbox SignUpForm-checkbox">
                                            <div class="CheckboxField">
                                                <div class="Checkbox-InputContainer"><input id="enableStripePass"
                                                        name="enableStripePass" type="checkbox"
                                                        class="Checkbox-Input"><span
                                                        class="Checkbox-StyledInput"></span></div><label
                                                    for="enableStripePass"><span
                                                        class="Checkbox-Label Text Text-color--gray600 Text-fontSize--13 Text-fontWeight--500">Save
                                                        my info for secure 1-click checkout</span></label>
                                            </div>
                                        </div><button class="Button SignUpForm-infoIcon Button--link Button--md"
                                            type="button">
                                            <div class="flex-container justify-content-center align-items-center"><svg
                                                    class="InlineSVG Icon Icon--sm Icon--square" focusable="false"
                                                    width="12" height="12" viewBox="0 0 12 12" fill="none">
                                                    <path
                                                        d="M6 12C9.28235 12 12 9.28235 12 6C12 2.72353 9.27647 0 5.99412 0C2.71765 0 0 2.72353 0 6C0 9.28235 2.72353 12 6 12ZM6 11C3.22353 11 1.00588 8.77647 1.00588 6C1.00588 3.22941 3.21765 1 5.99412 1C8.77059 1 10.9941 3.22941 11 6C11.0059 8.77647 8.77647 11 6 11ZM5.94706 3.90588C6.37647 3.90588 6.71177 3.56471 6.71177 3.14118C6.71177 2.71176 6.37647 2.37059 5.94706 2.37059C5.52353 2.37059 5.18235 2.71176 5.18235 3.14118C5.18235 3.56471 5.52353 3.90588 5.94706 3.90588ZM4.97059 9.23529H7.36471C7.60588 9.23529 7.79412 9.06471 7.79412 8.82353C7.79412 8.59412 7.60588 8.41177 7.36471 8.41177H6.63529V5.41765C6.63529 5.1 6.47647 4.88824 6.17647 4.88824H5.18235C4.94118 4.88824 4.75294 5.07059 4.75294 5.3C4.75294 5.54118 4.94118 5.71176 5.18235 5.71176H5.7V8.41177H4.97059C4.72941 8.41177 4.54118 8.59412 4.54118 8.82353C4.54118 9.06471 4.72941 9.23529 4.97059 9.23529Z"
                                                        fill="currentColor"></path>
                                                </svg></div>
                                        </button>
                                    </div>
                                    <div style="height: 0px; opacity: 0; pointer-events: none;">
                                        <div class="SignUpForm-explanation">Use Link with Stripe to securely save your
                                            payment information and pay faster on future purchases with Sk Designs and
                                            other supporting sites.&nbsp;You’ll receive a verification text to get
                                            started.</div>
                                        <div class="PhoneNumberInput">
                                            <div class="PhoneNumberInput-inputWrapper">
                                                <div class="CheckoutInputContainer">
                                                    <div class="CheckoutInputContainer-placeholderIcon"><svg
                                                            class="InlineSVG Icon Icon--md" focusable="false" width="16"
                                                            height="16" fill="none">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M10 1.532A1 1 0 019 2.5H7a1 1 0 01-1-.968 6.137 6.137 0 00-.048.004c-.408.033-.559.09-.633.127a1.5 1.5 0 00-.656.656c-.037.074-.094.225-.127.633C4.5 3.377 4.5 3.935 4.5 4.8v6.4c0 .865.001 1.423.036 1.848.033.408.09.559.127.633a1.5 1.5 0 00.656.655c.074.038.225.095.633.128.425.035.983.036 1.848.036h.4c.865 0 1.423-.001 1.848-.036.408-.033.559-.09.633-.128a1.5 1.5 0 00.655-.655c.038-.074.095-.225.128-.633.035-.425.036-.983.036-1.848V4.8c0-.865-.001-1.423-.036-1.848-.033-.408-.09-.559-.128-.633a1.5 1.5 0 00-.655-.656c-.074-.037-.225-.094-.633-.127A6.05 6.05 0 0010 1.532zm-6.673.106C3 2.28 3 3.12 3 4.8v6.4c0 1.68 0 2.52.327 3.162a3 3 0 001.311 1.311C5.28 16 6.12 16 7.8 16h.4c1.68 0 2.52 0 3.162-.327a3 3 0 001.311-1.311C13 13.72 13 12.88 13 11.2V4.8c0-1.68 0-2.52-.327-3.162A3 3 0 0011.362.327C10.72 0 9.88 0 8.2 0h-.4C6.12 0 5.28 0 4.638.327a3 3 0 00-1.311 1.311zM9 12a1 1 0 11-2 0 1 1 0 012 0z">
                                                            </path>
                                                        </svg></div><span class="InputContainer" data-max=""><input
                                                            class="CheckoutInput PhoneNumberInput-input SignUpForm-phoneInput CheckoutInput--hasPlaceholderIcon Input Input--empty"
                                                            autocomplete="tel" autocorrect="off" spellcheck="false"
                                                            id="phoneNumber" name="phoneNumber" type="tel"
                                                            placeholder="8123 4567" aria-invalid="false" tabindex="-1"
                                                            value=""></span>
                                                </div>
                                                <div class="PhoneNumberInput-dynamicIcons"><img class="p-FlagIcon"
                                                        src="https://js.stripe.com/v3/fingerprinted/img/FlagIcon-SG-2c180a8aa9b0f476d78274da45372143.svg"
                                                        alt="SG"></div>
                                            </div>
                                            <div class="PhoneNumberInput-errorMessageAnimation"
                                                style="height: 0px; opacity: 0; pointer-events: none;"><span
                                                    class="FieldError Text Text-color--red Text-fontSize--13"><span
                                                        aria-hidden="true"></span></span></div>
                                        </div>
                                        <div class="SignUpForm-footer mt2">
                                            <div class="Text Text-color--gray400 Text-fontSize--12">Link with Stripe
                                            </div><button class="Button SignUpForm-moreInfoLink Button--link Button--sm"
                                                type="button" disabled="">
                                                <div class="flex-container justify-content-center align-items-center">
                                                    More info</div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="PaymentForm-confirmPaymentContainer flex-item width-grow" style="padding: 8px;">
                                <div class="flex-item width-12"></div>
                                <div class="flex-item width-12"><button class="SubmitButton SubmitButton--incomplete"
                                        type="submit" data-testid="hosted-payment-submit-button"
                                        style="background-color: rgb(0, 116, 212); color: rgb(255, 255, 255);">
                                        <div class="SubmitButton-Shimmer"
                                            style="background: linear-gradient(to right, rgba(0, 116, 212, 0) 0%, rgb(58, 139, 238) 50%, rgba(0, 116, 212, 0) 100%);">
                                        </div>
                                        <div class="SubmitButton-TextContainer"><span
                                                class="SubmitButton-Text SubmitButton-Text--current Text Text-color--default Text-fontWeight--500 Text--truncate"
                                                aria-hidden="false">Pay $20.00</span><span
                                                class="SubmitButton-Text SubmitButton-Text--pre Text Text-color--default Text-fontWeight--500 Text--truncate"
                                                aria-hidden="true">Processing...</span></div>
                                        <div class="SubmitButton-IconContainer">
                                            <div class="SubmitButton-Icon SubmitButton-Icon--pre">
                                                <div class="Icon Icon--md Icon--square"><svg viewBox="0 0 16 16"
                                                        xmlns="http://www.w3.org/2000/svg" focusable="false">
                                                        <path
                                                            d="M3 7V5a5 5 0 1 1 10 0v2h.5a1 1 0 0 1 1 1v6a2 2 0 0 1-2 2h-9a2 2 0 0 1-2-2V8a1 1 0 0 1 1-1zm5 2.5a1 1 0 0 0-1 1v2a1 1 0 0 0 2 0v-2a1 1 0 0 0-1-1zM11 7V5a3 3 0 1 0-6 0v2z"
                                                            fill="#ffffff" fill-rule="evenodd"></path>
                                                    </svg></div>
                                            </div>
                                            <div
                                                class="SubmitButton-Icon SubmitButton-SpinnerIcon SubmitButton-Icon--pre">
                                                <div class="Icon Icon--md Icon--square"><svg viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg" focusable="false">
                                                        <ellipse cx="12" cy="12" rx="10" ry="10"
                                                            style="stroke: rgb(255, 255, 255);"></ellipse>
                                                    </svg></div>
                                            </div>
                                        </div>
                                        <div class="SubmitButton-CheckmarkIcon">
                                            <div class="Icon Icon--md"><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="22" height="14" focusable="false">
                                                    <path d="M 0.5 6 L 8 13.5 L 21.5 0" fill="transparent"
                                                        stroke-width="2" stroke="#ffffff" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </svg></div>
                                        </div>
                                    </button>
                                    <div class="ConfirmPayment-PostSubmit">
                                        <div>
                                            <div style="height: 0px; opacity: 0; pointer-events: none;">
                                                <div class="ConfirmTerms Text Text-color--gray500 Text-fontSize--13">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <footer class="App-Footer Footer">
            <div class="Footer-PoweredBy"><a class="Link Link--primary" href="https://stripe.com" target="_blank"
                    rel="noopener"><span class="Text Text-color--gray400 Text-fontSize--12 Text-fontWeight--400">Powered
                        by <svg class="InlineSVG Icon Footer-PoweredBy-Icon Icon--md" focusable="false" width="33"
                            height="15">
                            <g fill-rule="evenodd">
                                <path
                                    d="M32.956 7.925c0-2.313-1.12-4.138-3.261-4.138-2.15 0-3.451 1.825-3.451 4.12 0 2.719 1.535 4.092 3.74 4.092 1.075 0 1.888-.244 2.502-.587V9.605c-.614.307-1.319.497-2.213.497-.876 0-1.653-.307-1.753-1.373h4.418c0-.118.018-.588.018-.804zm-4.463-.859c0-1.02.624-1.445 1.193-1.445.55 0 1.138.424 1.138 1.445h-2.33zM22.756 3.787c-.885 0-1.454.415-1.77.704l-.118-.56H18.88v10.535l2.259-.48.009-2.556c.325.235.804.57 1.6.57 1.616 0 3.089-1.302 3.089-4.166-.01-2.62-1.5-4.047-3.08-4.047zm-.542 6.225c-.533 0-.85-.19-1.066-.425l-.009-3.352c.235-.262.56-.443 1.075-.443.822 0 1.391.922 1.391 2.105 0 1.211-.56 2.115-1.39 2.115zM18.04 2.766V.932l-2.268.479v1.843zM15.772 3.94h2.268v7.905h-2.268zM13.342 4.609l-.144-.669h-1.952v7.906h2.259V6.488c.533-.696 1.436-.57 1.716-.47V3.94c-.289-.108-1.346-.307-1.879.669zM8.825 1.98l-2.205.47-.009 7.236c0 1.337 1.003 2.322 2.34 2.322.741 0 1.283-.135 1.581-.298V9.876c-.289.117-1.716.533-1.716-.804V5.865h1.716V3.94H8.816l.009-1.96zM2.718 6.235c0-.352.289-.488.767-.488.687 0 1.554.208 2.241.578V4.202a5.958 5.958 0 0 0-2.24-.415c-1.835 0-3.054.957-3.054 2.557 0 2.493 3.433 2.096 3.433 3.17 0 .416-.361.552-.867.552-.75 0-1.708-.307-2.467-.723v2.15c.84.362 1.69.515 2.467.515 1.879 0 3.17-.93 3.17-2.548-.008-2.692-3.45-2.213-3.45-3.225z">
                                </path>
                            </g>
                        </svg></span></a></div>
            <div class="Footer-Links"><a class="Link Link--primary" href="https://stripe.com/checkout/terms"
                    target="_blank" rel="noopener"><span
                        class="Text Text-color--gray400 Text-fontSize--12 Text-fontWeight--400">Terms</span></a><a
                    class="Link Link--primary" href="https://stripe.com/privacy" target="_blank" rel="noopener"><span
                        class="Text Text-color--gray400 Text-fontSize--12 Text-fontWeight--400">Privacy</span></a></div>
        </footer>
    </div>
</div>