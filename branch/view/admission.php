<style>
.admission-section {
    padding: 40px 0;
    background: #fff;
}
.admission-section h2 {
    font-size: 28px;
    font-weight: 700;
    color: #333;
    margin-bottom: 15px;
    line-height: 1.4;
}
.admission-section p {
    font-size: 16px;
    line-height: 1.8;
    color: #555;
    margin-bottom: 20px;
}
.enquiry-btn {
    display: inline-block;
    background: #b39ddb;
    color: #333;
    padding: 12px 30px;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 600;
    font-size: 15px;
    transition: all 0.3s;
    margin-bottom: 25px;
    border: none;
}
.enquiry-btn:hover {
    background: #9575cd;
    color: #fff;
    transform: translateY(-2px);
}
.scholarship-box {
    background: #fff;
    border: 1px solid #eee;
    padding: 30px;
    border-radius: 10px;
    margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}
.scholarship-box h2 {
    font-size: 24px;
    font-weight: 700;
    color: #333;
    margin-bottom: 15px;
    text-transform: uppercase;
}
.scholarship-box p {
    font-size: 15px;
    line-height: 1.7;
    color: #555;
}
.contact-help-box {
    background: var(--primary-color);
    padding: 35px;
    border-radius: 10px;
    color: #fff;
    position: relative;
    overflow: hidden;
}
.contact-help-box::after {
    content: '';
    position: absolute;
    bottom: -20px;
    right: -20px;
    width: 150px;
    height: 150px;
    background: rgba(255,255,255,0.1);
    border-radius: 50%;
}
.contact-help-box h2 {
    font-size: 26px;
    font-weight: 700;
    color: #fff;
    margin-bottom: 20px;
}
.contact-help-box p {
    font-size: 16px;
    color: #fff;
    margin-bottom: 8px;
    font-weight: 600;
}
.contact-enquiry-btn {
    display: inline-block;
    background: #b39ddb;
    color: #333;
    padding: 12px 35px;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 600;
    font-size: 15px;
    transition: all 0.3s;
    margin-top: 15px;
    border: none;
}
.contact-enquiry-btn:hover {
    background: #9575cd;
    color: #fff;
    transform: translateY(-2px);
}
.fade-in-up {
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.6s ease;
}
.fade-in-up.visible {
    opacity: 1;
    transform: translateY(0);
}
</style>

<div class="admission-section">
    <div class="container-lg">
        <div class="row">
            <div class="col-md-8">
                <a href="https://forms.gle/XvSaB1CW9o7nRGKH9" target="_blank" class="enquiry-btn">Enquiry Now</a>
                
                <div class="fade-in-up">
                    <h2>Admission is done either in INTERVENTION PROGRAM (EIP/ GIP) or in the SCHOOL PROGRAM (ELC/ SLP/ican/ VTC/ ERT/ GES)</h2>
                    <p>Admission is based on specific ELIGIBITY CRITERIA. An assessment protocol helps the Sunrise Learning team to decide the eligibility of any child.</p>
                </div>
                
                <div class="fade-in-up">
                    <p>Once the student is found eligible for admission, the "program" is decided as per the age, skill level, independence, and adaptability of the child/ adult. In case there is no vacancy in that particular program, the student is put on the waiting list.</p>
                    <p>Once the vacancy is clear, the student is then given a slot for intervention (with a parent) or offered to undergo a TRIAL of 4-12 weeks based on the functional status of the student & his/her ability to cope. After the trial period, then, a discussion is done, that helps the team and the parents to take an informed decision about the admission and the "program" of the STUDENT.</p>
                    <p>Once the student is found eligible for admission, the "program" is decided as per the age, skill level, independence, and adaptability of the child/ adult. In case there is no vacancy in that particular program, the student is put on the waiting list.</p>
                    <p>Once the vacancy is clear, the student is then given a slot for intervention (with a parent) or offered to undergo a TRIAL of 4-12 weeks based on the functional status of the student & his/her ability to cope. After the trial period, then, a discussion is done, that helps the team and the parents to take an informed decision about the admission and the "program" of the STUDENT.</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="scholarship-box fade-in-up">
                    <h2>Admission With Scholarship</h2>
                    <p>If at any point of time a parent goes through a financial difficulty and would like to apply for a scholarship support for the ward, they are welcome to submit the SCHOLARSHIP FORM. Scholarships are provided to students who either belong to disadvantaged families or with specific criteria. Scholarships are always granted subject to financial status of the organization and need & eligibility of the applicants (based on ITRs and family income). Decision of the scholarship committee is final and binding.</p>
                    <p>The scholarship will be withdrawn in case the Foundation management finds that the documents submitted by the parents for Scholarship are forged/false/fake.</p>
                </div>
                
                <div class="contact-help-box fade-in-up">
                    <h2>How can we help you?</h2>
                    <p>contactus@sunriselearning.in</p>
                    <p>8585928038</p>
                    <p>7042979118</p>
                    <a href="https://forms.gle/To9EvTEcQYPmVHaZA" target="_blank" class="contact-enquiry-btn">Enquiry Now</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function animateOnScroll() {
    document.querySelectorAll('.fade-in-up').forEach(el => {
        const rect = el.getBoundingClientRect();
        if (rect.top < window.innerHeight - 100) {
            el.classList.add('visible');
        }
    });
}
window.addEventListener('scroll', animateOnScroll);
window.addEventListener('load', animateOnScroll);
</script>
