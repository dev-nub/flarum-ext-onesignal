import Modal from 'flarum/components/Modal';


export default class OneSignalUser extends Modal {
    init() {
        super.init();

    }

    className() {
        return 'OneSignalUser Modal--small';
    }

    title() {
        return 'OneSignal User';
    }

    content() {
        return [];
    }

    data() {
        return {
            vivek: 'soni',
        };
    }

    onsubmit(e) {
        e.preventDefault();


        this.props.user.save(this.data(), { errorHandler: this.onerror.bind(this) })
            .then(this.hide.bind(this))
            .then($('#app').trigger('refreshSocialButtons', [this.data().socialButtons]))
            .catch(() => {
                this.loading = false;
                m.redraw();
            });
    }
}
