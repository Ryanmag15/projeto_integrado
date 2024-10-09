const Routes = {
    auth: {
        login: '/auth/login',
        register: '/auth/user',
        confirm_authenticity: '/auth/user/confirm_authenticity',
        resend_authenticity: '/auth/user/resend_authenticity',
        resend_new_user: '/auth/user/resend_new_user_authenticity',
        refresh_token: '/auth/refresh_token',
        forgot_password: '/auth/forgot_password',
        password_reset: '/auth/password',
        new_password: '/auth/new_password',
        mfa_verify: '/auth/mfa-verify',
    },
    authenticity: {
        generate: '/authenticity/generate',
    },
    users: {
        register: '/users/',
        delete: '/users/delete',
        list: '/users/list',
        listNoCompany: '/users/list/no-company',
        block: '/admin/users',
        own_company: '/users/own/companies',
        mfa_reset: '/admin/users/mfa-reset',
    },
    profiles: {
        list: '/profile/list',
    },
    permissions: {
        listByUser: '/permissions/user',
        listByProfile: '/permissions/profile',
    },
    account_settings: {
        save: '/admin/account_settings',
        get: '/admin/account_settings',
    },
    company_settings: {
        save: '/admin/company_settings',
        get: '/admin/company_settings',
    },
    fgts: {
        consult: '/fgts',
        simulation: '/fgts/simulation',
        confirmation: '/fgts/operation',
        config: '/admin/company_settings/fgts',
        report: '/reports/operations/fgts',
        reportGeneral: '/reports/operations/fgts/general',
    },
    billing: {
        create: '/billing/new',
    },
    pix: {
        config: '/admin/account_settings/pix',
    },
    account_preferrences: {
        get: '/accounts/preferences',
    },
};
Object.freeze(Routes);

export default Routes;
