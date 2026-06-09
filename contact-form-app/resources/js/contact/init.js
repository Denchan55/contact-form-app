

document.addEventListener('DOMContentLoaded', () => {
    const tel1 = document.getElementById('tel1');
    const tel2 = document.getElementById('tel2');
    const tel3 = document.getElementById('tel3');
    const telHidden = document.getElementById('tel');


    if (!tel1 || !tel2 || !tel3 || !telHidden) {
        return; // 電話番号欄がないページでは何もしない
    }
    const updateTel = () => {
        const t1 = tel1.value.trim();
        const t2 = tel2.value.trim();
        const t3 = tel3.value.trim();

        if (t1 && t2 && t3) {
            telHidden.value = `${t1}${t2}${t3}`;
        } else {
            telHidden.value = '';
        }
    };

    tel1.addEventListener('input', updateTel);
    tel2.addEventListener('input', updateTel);
    tel3.addEventListener('input', updateTel);

    updateTel(); 
});

