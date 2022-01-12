export interface User {
    /**
     * Users ID
     */
    id: number;
    /**
     * Users first name
     */
    first_name: string;
    /**
     * Users last name
     */
    last_name: string;
    /**
     * Users username
     */
    username: string;
    /**
     * Users e-mail address
     */
    email?: string;
}