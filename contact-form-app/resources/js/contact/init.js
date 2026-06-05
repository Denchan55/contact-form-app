import { initPhoneField } from './phone-field-handler.js';

document.addEventListener('DOMContentLoaded', () => {
    const tel1 = document.getElementById('tel1');
    const tel2 = document.getElementById('tel2');
    const tel3 = document.getElementById('tel3');
    const telHidden = document.getElementById('tel');

    const updateTel = () => {
        const t1 = tel1.value.trim();
        const t2 = tel2.value.trim();
        const t3 = tel3.value.trim();

        // どれかが空でも無理に結合しない（バリデーションに任せる）
        if (t1 && t2 && t3) {
            telHidden.value = `${t1}-${t2}-${t3}`;
        }
    };

    tel1.addEventListener('input', updateTel);
    tel2.addEventListener('input', updateTel);
    tel3.addEventListener('input', updateTel);
});

