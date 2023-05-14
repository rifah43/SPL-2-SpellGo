import { useEffect } from 'react';
import Checkbox from '@/Components/Checkbox';
import GuestLayout from '@/Layouts/GuestLayout';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Head, Link, useForm } from '@inertiajs/react';

export default function Login({ status, canResetPassword }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        email: '',
        password: '',
        remember: false,
    });

    useEffect(() => {
        return () => {
            reset('password');
        };
    }, []);

    const submit = (e) => {
        e.preventDefault();

        post(route('login'));
    };

    return (
        <GuestLayout>
            <Head title="Log in" />

            {status && <div className="mb-4 font-medium text-sm text-green-600">{status}</div>}

            <form onSubmit={submit}>
                <div className="mb-4">
                    <InputLabel htmlFor="email" value="Email" className="block text-gray-700 text-sm font-bold mb-2" />
                    <TextInput
                    id="email"
                    type="email"
                    name="email"
                    value={data.email}
                    className="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500"
                    autoComplete="username"
                    isFocused={true}
                    onChange={(e) => setData('email', e.target.value)}
                />

                    <InputError message={errors.email} className="mt-2 text-red-500 text-sm" />
                </div>

                <div className="mb-4">
                    <InputLabel htmlFor="password" value="Password" className="block text-gray-700 text-sm font-bold mb-2" />

                    <TextInput
                        id="password"
                        type="password"
                        name="password"
                        value={data.password}
                        className="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500"
                        autoComplete="current-password"
                        onChange={(e) => setData('password', e.target.value)}
                    />

                    <InputError message={errors.password} className="mt-2 text-red-500 text-sm" />
                </div>

                <div className="mb-4">
                    <label className="flex items-center">
                        <Checkbox
                            name="remember"
                            checked={data.remember}
                            onChange={(e) => setData('remember', e.target.checked)}
                            className="focus:ring-pink-500 h-4 w-4 text-pink-600 border-gray-300 rounded"
                        />
                        <span className="ml-2 text-gray-700 text-sm">Remember me</span>
                    </label>
                </div>

                <div className="flex items-center justify-between">
                    {canResetPassword && (
                        <Link
                            href={route('password.request')}
                            className="inline-block align-baseline font-bold text-sm text-pink-600 hover:text-pink-800"
                        >
                            Forgot your password?
                        </Link>
                    )}

                    <PrimaryButton className="px-4 py-2 rounded text-white bg-pink-500 hover:bg-pink-700 focus:outline-none focus:shadow-outline-pink focus:ring-2 focus:ring-offset-2 focus:ring-pink-500" disabled={processing}>
                        Log in
                    </PrimaryButton>
                </div>
                <div className="flex left">
                <Link
                        href={route('register')}
                        className="inline-block align-baseline font-bold text-sm text-pink-600 hover:text-pink-800"
                    >
                        New Here? Register!
                    </Link>
                </div>
            </form>

        </GuestLayout>
    );
}
