<tr>
    <td>
        <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <tr>
                <td class="content-cell--two" align="center">
                    <span>
                        <a href="https://www.facebook.com/belezalabbr">
                            <img class="social-mail" src="https://belezalab.com.br/img/001-facebook.png" alt="facebook">
                        </a>

                    </span>

                    <span>
                        <a href="https://www.instagram.com/belezalabbr/">
                            <img class="social-mail" src="https://belezalab.com.br/img/011-instagram.png"
                                alt="instagram">
                        </a>

                    </span>
                </td>
            </tr>
            <tr>
                <td class="content-cell" align="center">
                    {{ Illuminate\Mail\Markdown::parse($slot) }}
                </td>

            </tr>
        </table>
    </td>
</tr>
