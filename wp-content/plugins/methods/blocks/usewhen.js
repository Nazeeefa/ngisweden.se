var el = wp.element.createElement;
var registerBlockType = wp.blocks.registerBlockType;
var RichText = wp.editor.RichText;
var InnerBlocks = wp.editor.InnerBlocks;

registerBlockType( 'methods/usewhen', {
    title: 'Use when',
    icon: 'editor-help',
    category: 'methods',
    attributes: {
        content: {
            type: 'string',
            source: 'html'
        }
    },
    edit: function( props ) {
        var content = props.attributes.content;
        function onChangeContent( newContent ) {
            props.setAttributes( { content: newContent } );
        }
        return [
            el( 'div', { className: props.className },
                el( InnerBlocks, {
                    className: props.className,
                    onChange: onChangeContent,
                    value: content,
                    template: [
                        ['core/paragraph', { content: 'You may want to use this protocol when:' }],
                        ['core/list'],
                    ]
                } ),
            ),
        ];
    },
    save: function( props ) {
        var content = props.attributes.content;
        return [
            el( 'div', { className: props.className },
                el( InnerBlocks.Content, {
                    className: props.className,
                    value: content
                } ),
            ),
        ];
    },
} );
